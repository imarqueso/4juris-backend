# GestãoStock

Bem-vindo ao repositório do Teste da 4Juris, um sistema desenvolvido em Laravel.

## Instalação

Siga os passos abaixo para configurar e executar localmente o GestãoStock em seu ambiente:

1. **Clone o repositório:**

   ```git clone https://github.com/imarqueso/teste-4juris-backend.git teste-4juris```

2. **Abra a pasta do sistema no terminal:**

   ```cd teste-4juris```
   
3. **Instale o composer:**

   ```composer install```

4. **Crie ou edite o arquivo .env (Configure o arquivo .env com suas informações de banco de dados e outras configurações necessárias.):**

   ```cp .env.example .env```

5. **No .env adicione o seguinte valor a variavel APP_URL:**

  ```http://localhost:8000```

6. **No .env adicione os dados do banco MySQL**

7. **Gere a chave de aplicativo:**

   ```php artisan key:generate```

8. **Execute as migrações do banco de dados:**

   ```php artisan migrate```

9. **Execute o seed do banco de dados:**

   ```php artisan db:seed```

10. **Para saber os dados de acesso ao sistema verifique o arquivo AdminSeeder.php:**



