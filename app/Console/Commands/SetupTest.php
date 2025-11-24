<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SetupTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera tenant, usuário de testes e token Sanctum para avaliação de multi-adquirência em ambiente local';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando configuração do ambiente de testes...');

        //Rodando migrations
        $this->info('Rodando migrations...');
        Artisan::call('migrate:fresh');

        //Criar tenancy de testes
        $this->info('Criando Tenancy de testes...');
        $tenancy = Tenant::firstOrCreate(
            ['name' => 'Joinvix'],
            ['domain' => 'localhost']
        );

        //Criar usuário de testes
        $this->info('Criando usuário de testes...');
        $user = User::firstOrCreate(
            ['email' => 'joao@teste.com'],
            [
                'tenant_id' => $tenancy->id,
                'name' => 'joao de teste',
                'password' => Hash::make('password'),
            ]
        );

        //Gerar token Sanctum
        $this->info('Gerando token de API...');
        $token = $user->createToken('test-token')->plainTextToken;

        $this->info('Salvando token no arquivo config/api.php...');

        $configPath = config_path('api.php');
        $configContent = File::get($configPath);

        // substitui linha existente
        if (preg_match('/\'test_token\'\s*=>\s*[\'"](.*)[\'"]/', $configContent)) {
            $configContent = preg_replace(
                '/\'test_token\'\s*=>\s*[\'"](.*)[\'"]/',
                "'test_token' => '{$token}'",
                $configContent
            );
        } else {
            // se não existir no arquivo, adiciona no final do array
            $configContent = preg_replace(
                '/return\s*\[/',
                "return [\n    'test_token' => '{$token}',",
                $configContent
            );
        }

        File::put($configPath, $configContent);

        // limpar cache para garantir que o novo token é carregado
        Artisan::call('config:clear');

        $this->info('Processo concluído!');
        $this->line('');
        $this->line('**Ambiente configurado com sucesso!**');
        $this->line("Usuário: joao@teste.com");
        $this->line("Senha:   password");
        $this->line("Token:   {$token}");
        $this->line('');
        $this->line('Você já pode usar o token automaticamente via ENV: test_token');
        $this->line('');

        return Command::SUCCESS;
    }
}
