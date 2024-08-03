<?php

namespace App\Filament\Resources\UserEndTestFileResource\Pages;

use App\Filament\Resources\UserEndTestFileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserEndTestFile extends EditRecord
{
    protected static string $resource = UserEndTestFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
