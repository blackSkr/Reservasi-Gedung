<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Doctrine\DBAL\Schema\Column;
use Filament\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Pages\Auth\Register as AuthRegister;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;


class Register extends AuthRegister
{

    protected static string $view = 'filament.pages.auth.register';

    protected ?string $maxWidth = '2xl';

    protected function handleRegistration(array $data): Model
    {

        // dd($data);
        $user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'password' => $data['password'],
            // 'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('user');

        return $user;
        
        
    }

    public function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\TextInput::make("nama")
                ->label("Nama")
                ->required()
                ->maxLength(50)
                ->rule('regex:/^[A-Za-z\s]+$/') 
                ->columnSpanFull(),
                $this->getEmailFormComponent()
                    ->label("Email")
                    ->unique($this->getUserModel())
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('no_hp')
                    ->label("Nomor Telepon / WA Aktif")
                    ->columnSpanFull()
                    ->maxLength(14)
                    ->numeric() 
                    ->rule('regex:/^[0-9]+$/') 
                    ->required()
                    ->unique($this->getUserModel()),
                Forms\Components\TextInput::make('alamat')
                    ->label("Alamat Lengkap")
                    ->columnSpanFull()
                    ->required(),
                $this->getPasswordFormComponent()
                    ->label("Kata Sandi")
                    ->maxLength(20)
                    ->columnSpanFull(),
                $this->getPasswordConfirmationFormComponent()
                    ->label("Konfirmasi kata Sandi")
                    ->maxLength(20)
                    ->columnSpanFull(),
            ])
            ->columns(2)
            ->statePath('data');
    }

    

    public function loginAction(): Action
    {
        return parent::loginAction()
            ->label('Masuk jika sudah punya akun');
    }

    public function homeAction(): Action
    {
        return Action::make('home')
            ->link()
            ->label('Kembali ke Beranda')
            ->url('/');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getRegisterFormAction()
                ->label('Daftar'),
        ];
    }
    

}