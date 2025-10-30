# Bora de Bike - Portal Oficial

Portal para divulgação de eventos de ciclismo com sistema de inscrições e painel administrativo.

## 🚀 Tecnologias Utilizadas

- **Backend**: Laravel 11
- **Banco de Dados**: MySQL 8.0
- **Frontend**: Tailwind CSS + Blade Templates
- **Autenticação**: Laravel Breeze
- **RBAC**: Spatie Laravel Permission
- **Painel Admin**: Filament
- **Containerização**: Docker + Docker Compose
- **Cache**: Redis
- **E-mail**: Mailhog (desenvolvimento)

## 📋 Funcionalidades

### Portal Público
- ✅ Landing page responsiva com todas as seções
- ✅ Contador regressivo para o evento
- ✅ Formulário de inscrição multi-step
- ✅ Validação de CPF em tempo real
- ✅ Integração com ViaCEP para preenchimento automático de endereço
- ✅ Sistema de kits limitados
- ✅ Galeria de fotos
- ✅ Seção de parceiros
- ✅ E-mail de confirmação de inscrição

### Painel Administrativo
- ✅ Dashboard com estatísticas
- ✅ Gerenciamento de eventos
- ✅ Gerenciamento de inscrições
- ✅ Gerenciamento de galeria
- ✅ Gerenciamento de parceiros
- ✅ Sistema de usuários e permissões
- ✅ Exportação de dados

### Sistema de Permissões
- **Admin**: Acesso total ao sistema
- **Editor**: Gerenciamento de conteúdo (eventos, inscrições, galeria, parceiros)
- **Visualizador**: Apenas visualização de dados

## 🐳 Instalação e Configuração

### Pré-requisitos
- Docker
- Docker Compose

### 1. Clone o repositório
```bash
git clone <repository-url>
cd boradebikeoficial
```

### 2. Configure o ambiente Docker
```bash
# Construir e iniciar os containers
docker compose up -d --build

# Instalar dependências do Laravel
docker compose exec app composer install

# Configurar o ambiente
docker compose exec app cp .env.example .env

# Gerar chave da aplicação
docker compose exec app php artisan key:generate

# Executar migrações e seeders
docker compose exec app php artisan migrate:fresh --seed
```

### 3. Acessar a aplicação
- **Portal Público**: http://localhost
- **Painel Admin**: http://localhost/admin
- **Mailhog**: http://localhost:8025

### 4. Credenciais padrão
- **E-mail**: admin@boradebike.com
- **Senha**: password

## 📁 Estrutura do Projeto

```
boradebikeoficial/
├── app/
│   ├── Filament/
│   │   ├── Resources/          # Recursos do Filament
│   │   └── Widgets/           # Widgets do dashboard
│   ├── Http/
│   │   └── Controllers/       # Controllers da aplicação
│   └── Models/                # Models Eloquent
├── database/
│   ├── migrations/            # Migrações do banco
│   └── seeders/               # Seeders com dados iniciais
├── docker/                    # Configurações Docker
├── resources/
│   ├── views/                 # Templates Blade
│   │   ├── layouts/          # Layouts base
│   │   └── emails/           # Templates de e-mail
│   └── css/                  # Estilos CSS
├── routes/
│   └── web.php               # Rotas web
└── docker-compose.yml        # Configuração Docker Compose
```

## 🗄️ Estrutura do Banco de Dados

### Tabelas Principais
- **events**: Informações dos eventos
- **registrations**: Inscrições dos participantes
- **gallery_images**: Imagens da galeria
- **partners**: Parceiros do evento
- **users**: Usuários do sistema
- **roles**: Papéis de usuário
- **permissions**: Permissões do sistema

## 🔧 Comandos Úteis

### Docker
```bash
# Iniciar containers
docker compose up -d

# Parar containers
docker compose down

# Ver logs
docker compose logs -f app

# Executar comandos no container
docker compose exec app <comando>
```

### Laravel
```bash
# Executar migrações
docker compose exec app php artisan migrate

# Executar seeders
docker compose exec app php artisan db:seed

# Limpar cache
docker compose exec app php artisan cache:clear

# Gerar cache de configuração
docker compose exec app php artisan config:cache
```

## 📧 Configuração de E-mail

O projeto está configurado para usar Mailhog em desenvolvimento. Para configurar e-mail em produção:

1. Configure as variáveis de ambiente no `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=seu-servidor-smtp
MAIL_PORT=587
MAIL_USERNAME=seu-email
MAIL_PASSWORD=sua-senha
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@boradebike.com
MAIL_FROM_NAME="Bora de Bike"
```

## 🎨 Personalização

### Cores e Estilos
- Edite o arquivo `resources/views/layouts/app.blade.php` para personalizar cores e estilos
- As classes Tailwind podem ser modificadas conforme necessário

### Conteúdo
- Use o painel administrativo para gerenciar eventos, inscrições e conteúdo
- Os seeders podem ser modificados para incluir dados específicos

## 🚀 Deploy

### Produção
1. Configure as variáveis de ambiente para produção
2. Configure o servidor web (Nginx/Apache)
3. Configure o banco de dados MySQL
4. Execute as migrações e seeders
5. Configure o cache e otimizações

### Docker em Produção
```bash
# Build para produção
docker compose -f docker-compose.prod.yml up -d --build
```

## 📱 Responsividade

O portal é totalmente responsivo e funciona em:
- ✅ Desktop
- ✅ Tablet
- ✅ Mobile

## 🔒 Segurança

- ✅ Validação de CSRF
- ✅ Sanitização de inputs
- ✅ Validação de CPF
- ✅ Sistema de permissões granular
- ✅ Proteção contra SQL Injection (Eloquent ORM)

## 🐛 Troubleshooting

### Problemas Comuns

1. **Erro de permissão no Docker**
   ```bash
   sudo chown -R $USER:$USER .
   ```

2. **Container não inicia**
   ```bash
   docker compose down
   docker compose up -d --build
   ```

3. **Erro de banco de dados**
   ```bash
   docker compose exec app php artisan migrate:fresh --seed
   ```

4. **Cache desatualizado**
   ```bash
   docker compose exec app php artisan cache:clear
   docker compose exec app php artisan config:cache
   ```

## 📞 Suporte

Para suporte técnico ou dúvidas sobre o projeto:
- **E-mail**: contato@boradebike.com
- **Telefone**: (22) 99999-9999

## 📄 Licença

Este projeto é propriedade do Bora de Bike. Todos os direitos reservados.

---

**Desenvolvido com ❤️ para a comunidade ciclística**
# Instalar dependências do Laravel
docker compose exec app composer install

# Configurar o ambiente
docker compose exec app cp .env.example .env

# Gerar chave da aplicação
docker compose exec app php artisan key:generate

# Executar migrações e seeders
docker compose exec app php artisan migrate:fresh --seed
```

### 3. Acessar a aplicação
- **Portal Público**: http://localhost
- **Painel Admin**: http://localhost/admin
- **Mailhog**: http://localhost:8025

### 4. Credenciais padrão
- **E-mail**: admin@boradebike.com
- **Senha**: password

## 📁 Estrutura do Projeto

```
boradebikeoficial/
├── app/
│   ├── Filament/
│   │   ├── Resources/          # Recursos do Filament
│   │   └── Widgets/           # Widgets do dashboard
│   ├── Http/
│   │   └── Controllers/       # Controllers da aplicação
│   └── Models/                # Models Eloquent
├── database/
│   ├── migrations/            # Migrações do banco
│   └── seeders/               # Seeders com dados iniciais
├── docker/                    # Configurações Docker
├── resources/
│   ├── views/                 # Templates Blade
│   │   ├── layouts/          # Layouts base
│   │   └── emails/           # Templates de e-mail
│   └── css/                  # Estilos CSS
├── routes/
│   └── web.php               # Rotas web
└── docker-compose.yml        # Configuração Docker Compose
```

## 🗄️ Estrutura do Banco de Dados

### Tabelas Principais
- **events**: Informações dos eventos
- **registrations**: Inscrições dos participantes
- **gallery_images**: Imagens da galeria
- **partners**: Parceiros do evento
- **users**: Usuários do sistema
- **roles**: Papéis de usuário
- **permissions**: Permissões do sistema

## 🔧 Comandos Úteis

### Docker
```bash
# Iniciar containers
docker compose up -d

# Parar containers
docker compose down

# Ver logs
docker compose logs -f app

# Executar comandos no container
docker compose exec app <comando>
```

### Laravel
```bash
# Executar migrações
docker compose exec app php artisan migrate

# Executar seeders
docker compose exec app php artisan db:seed

# Limpar cache
docker compose exec app php artisan cache:clear

# Gerar cache de configuração
docker compose exec app php artisan config:cache
```

## 📧 Configuração de E-mail

O projeto está configurado para usar Mailhog em desenvolvimento. Para configurar e-mail em produção:

1. Configure as variáveis de ambiente no `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=seu-servidor-smtp
MAIL_PORT=587
MAIL_USERNAME=seu-email
MAIL_PASSWORD=sua-senha
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@boradebike.com
MAIL_FROM_NAME="Bora de Bike"
```

## 🎨 Personalização

### Cores e Estilos
- Edite o arquivo `resources/views/layouts/app.blade.php` para personalizar cores e estilos
- As classes Tailwind podem ser modificadas conforme necessário

### Conteúdo
- Use o painel administrativo para gerenciar eventos, inscrições e conteúdo
- Os seeders podem ser modificados para incluir dados específicos

## 🚀 Deploy

### Produção
1. Configure as variáveis de ambiente para produção
2. Configure o servidor web (Nginx/Apache)
3. Configure o banco de dados MySQL
4. Execute as migrações e seeders
5. Configure o cache e otimizações

### Docker em Produção
```bash
# Build para produção
docker compose -f docker-compose.prod.yml up -d --build
```

## 📱 Responsividade

O portal é totalmente responsivo e funciona em:
- ✅ Desktop
- ✅ Tablet
- ✅ Mobile

## 🔒 Segurança

- ✅ Validação de CSRF
- ✅ Sanitização de inputs
- ✅ Validação de CPF
- ✅ Sistema de permissões granular
- ✅ Proteção contra SQL Injection (Eloquent ORM)

## 🐛 Troubleshooting

### Problemas Comuns

1. **Erro de permissão no Docker**
   ```bash
   sudo chown -R $USER:$USER .
   ```

2. **Container não inicia**
   ```bash
   docker compose down
   docker compose up -d --build
   ```

3. **Erro de banco de dados**
   ```bash
   docker compose exec app php artisan migrate:fresh --seed
   ```

4. **Cache desatualizado**
   ```bash
   docker compose exec app php artisan cache:clear
   docker compose exec app php artisan config:cache
   ```

## 📞 Suporte

Para suporte técnico ou dúvidas sobre o projeto:
- **E-mail**: contato@boradebike.com
- **Telefone**: (22) 99999-9999

## 📄 Licença

Este projeto é propriedade do Bora de Bike. Todos os direitos reservados.

---

**Desenvolvido com ❤️ para a comunidade ciclística**