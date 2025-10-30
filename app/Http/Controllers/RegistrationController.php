<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\SiteSetting;
use App\Rules\ValidCpf;
use App\Rules\UniqueCpf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        // Garantir que sempre retorna JSON para requisições AJAX
        $request->headers->set('Accept', 'application/json');
        
        // Verificar se as inscrições estão habilitadas
        $registrationEnabledValue = SiteSetting::get('registration_enabled', 'true');
        $registrationEnabled = filter_var($registrationEnabledValue, FILTER_VALIDATE_BOOLEAN);
        if (!$registrationEnabled) {
            return response()->json([
                'success' => false,
                'message' => 'As inscrições estão temporariamente desabilitadas'
            ], 403);
        }

        // Verificar se as inscrições ainda estão abertas
        $registrationDeadline = SiteSetting::get('registration_deadline');
        if ($registrationDeadline && now()->isAfter($registrationDeadline)) {
            return response()->json([
                'success' => false,
                'message' => 'As inscrições foram encerradas em ' . \Carbon\Carbon::parse($registrationDeadline)->format('d/m/Y H:i')
            ], 403);
        }

        // Limpar CPF para validação de unicidade
        $cpfClean = preg_replace('/[^0-9]/', '', $request->cpf ?? '');
        
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'cpf' => [
                'required', 
                'string', 
                'min:11', 
                'max:14', 
                new ValidCpf(),
                new UniqueCpf()
            ],
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:masculino,feminino,outro',
            'shirt_size' => 'required|in:PP,P,M,G,GG,XG',
            'zip_code' => 'required|string|size:9',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            'accepted_regulations' => 'required|in:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Limpar CPF para uso posterior (já validado pela Rule UniqueCpf)
        $cpfClean = preg_replace('/[^0-9]/', '', $request->cpf);

        $event = Event::where('is_active', true)->first();
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento não encontrado'
            ], 404);
        }

        // Check if kits are still available
        $remainingKits = $event->getRemainingKits();
        $hasKit = $remainingKits > 0;

        try {
            // Limpar CEP antes de salvar (remover hífen)
            $zipCode = preg_replace('/[^0-9]/', '', $request->zip_code);
            
            $registration = Registration::create([
                'event_id' => $event->id,
                'full_name' => $request->full_name,
                'cpf' => $cpfClean, // CPF sem formatação (já limpo acima)
                'email' => $request->email,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'shirt_size' => $request->shirt_size,
                'zip_code' => $zipCode, // CEP sem formatação
                'address' => $request->address,
                'number' => $request->number,
                'neighborhood' => $request->neighborhood,
                'city' => $request->city,
                'state' => strtoupper($request->state),
                'country' => 'Brasil',
                'has_kit' => $hasKit,
                'terms_accepted' => $request->has('accepted_regulations') && $request->accepted_regulations == '1', // Mantém compatibilidade
                'accepted_regulations' => $request->has('accepted_regulations') && $request->accepted_regulations == '1',
                'is_active' => true,
            ]);

            // Send confirmation email
            try {
                Mail::send('emails.registration-confirmation', [
                    'registration' => $registration,
                    'event' => $event
                ], function ($message) use ($registration) {
                    $message->to($registration->email)
                        ->subject('Confirmação de Inscrição - Bora de Bike');
                });
            } catch (\Exception $e) {
                Log::error('Erro ao enviar email de confirmação: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Inscrição realizada com sucesso!',
                'has_kit' => $hasKit,
                'remaining_kits' => $hasKit ? $remainingKits - 1 : $remainingKits
            ], 200);
            
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Erro ao salvar inscrição no banco: ' . $e->getMessage());
            Log::error('SQL: ' . $e->getSql());
            Log::error('Bindings: ' . json_encode($e->getBindings()));
            
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar inscrição. Por favor, tente novamente ou entre em contato com o suporte.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('Erro inesperado ao processar inscrição: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro inesperado. Por favor, tente novamente.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function checkCpf(Request $request)
    {
        $cpf = $request->input('cpf');
        // Limpar CPF (remover formatação)
        $cpfClean = preg_replace('/[^0-9]/', '', $cpf);
        
        if (empty($cpfClean) || strlen($cpfClean) !== 11) {
            return response()->json([
                'available' => false,
                'message' => 'CPF inválido'
            ]);
        }
        
        if (Registration::where('cpf', $cpfClean)->exists()) {
            return response()->json([
                'available' => false,
                'message' => 'CPF já cadastrado'
            ]);
        }

        return response()->json([
            'available' => true,
            'message' => 'CPF disponível'
        ]);
    }
}

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        // Garantir que sempre retorna JSON para requisições AJAX
        $request->headers->set('Accept', 'application/json');
        
        // Verificar se as inscrições estão habilitadas
        $registrationEnabledValue = SiteSetting::get('registration_enabled', 'true');
        $registrationEnabled = filter_var($registrationEnabledValue, FILTER_VALIDATE_BOOLEAN);
        if (!$registrationEnabled) {
            return response()->json([
                'success' => false,
                'message' => 'As inscrições estão temporariamente desabilitadas'
            ], 403);
        }

        // Verificar se as inscrições ainda estão abertas
        $registrationDeadline = SiteSetting::get('registration_deadline');
        if ($registrationDeadline && now()->isAfter($registrationDeadline)) {
            return response()->json([
                'success' => false,
                'message' => 'As inscrições foram encerradas em ' . \Carbon\Carbon::parse($registrationDeadline)->format('d/m/Y H:i')
            ], 403);
        }

        // Limpar CPF para validação de unicidade
        $cpfClean = preg_replace('/[^0-9]/', '', $request->cpf ?? '');
        
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'cpf' => [
                'required', 
                'string', 
                'min:11', 
                'max:14', 
                new ValidCpf(),
                new UniqueCpf()
            ],
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:masculino,feminino,outro',
            'shirt_size' => 'required|in:PP,P,M,G,GG,XG',
            'zip_code' => 'required|string|size:9',
            'address' => 'required|string|max:255',
            'number' => 'required|string|max:10',
            'neighborhood' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            'accepted_regulations' => 'required|in:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Limpar CPF para uso posterior (já validado pela Rule UniqueCpf)
        $cpfClean = preg_replace('/[^0-9]/', '', $request->cpf);

        $event = Event::where('is_active', true)->first();
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Evento não encontrado'
            ], 404);
        }

        // Check if kits are still available
        $remainingKits = $event->getRemainingKits();
        $hasKit = $remainingKits > 0;

        try {
            // Limpar CEP antes de salvar (remover hífen)
            $zipCode = preg_replace('/[^0-9]/', '', $request->zip_code);
            
            $registration = Registration::create([
                'event_id' => $event->id,
                'full_name' => $request->full_name,
                'cpf' => $cpfClean, // CPF sem formatação (já limpo acima)
                'email' => $request->email,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'shirt_size' => $request->shirt_size,
                'zip_code' => $zipCode, // CEP sem formatação
                'address' => $request->address,
                'number' => $request->number,
                'neighborhood' => $request->neighborhood,
                'city' => $request->city,
                'state' => strtoupper($request->state),
                'country' => 'Brasil',
                'has_kit' => $hasKit,
                'terms_accepted' => $request->has('accepted_regulations') && $request->accepted_regulations == '1', // Mantém compatibilidade
                'accepted_regulations' => $request->has('accepted_regulations') && $request->accepted_regulations == '1',
                'is_active' => true,
            ]);

            // Send confirmation email
            try {
                Mail::send('emails.registration-confirmation', [
                    'registration' => $registration,
                    'event' => $event
                ], function ($message) use ($registration) {
                    $message->to($registration->email)
                        ->subject('Confirmação de Inscrição - Bora de Bike');
                });
            } catch (\Exception $e) {
                Log::error('Erro ao enviar email de confirmação: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Inscrição realizada com sucesso!',
                'has_kit' => $hasKit,
                'remaining_kits' => $hasKit ? $remainingKits - 1 : $remainingKits
            ], 200);
            
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Erro ao salvar inscrição no banco: ' . $e->getMessage());
            Log::error('SQL: ' . $e->getSql());
            Log::error('Bindings: ' . json_encode($e->getBindings()));
            
            return response()->json([
                'success' => false,
                'message' => 'Erro ao salvar inscrição. Por favor, tente novamente ou entre em contato com o suporte.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
            
        } catch (\Exception $e) {
            Log::error('Erro inesperado ao processar inscrição: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro inesperado. Por favor, tente novamente.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function checkCpf(Request $request)
    {
        $cpf = $request->input('cpf');
        // Limpar CPF (remover formatação)
        $cpfClean = preg_replace('/[^0-9]/', '', $cpf);
        
        if (empty($cpfClean) || strlen($cpfClean) !== 11) {
            return response()->json([
                'available' => false,
                'message' => 'CPF inválido'
            ]);
        }
        
        if (Registration::where('cpf', $cpfClean)->exists()) {
            return response()->json([
                'available' => false,
                'message' => 'CPF já cadastrado'
            ]);
        }

        return response()->json([
            'available' => true,
            'message' => 'CPF disponível'
        ]);
    }
}
