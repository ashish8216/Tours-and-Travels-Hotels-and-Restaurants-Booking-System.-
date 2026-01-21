<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set as UtilitiesSet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Schemas\Components\Section::make('Blog Details')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state,UtilitiesSet $set) {
                                // Only set slug if title is not empty
                                if (!empty($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Will be auto-generated from title if left empty'),

                        Textarea::make('excerpt')
                            ->rows(3)
                            ->maxLength(500),

                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->disk('public')
                            ->directory('blogs')
                            ->image()
                            ->maxSize(2048),
                    ]),

                Section::make('Publishing')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(false),

                        DateTimePicker::make('published_at')
                            ->label('Publish Date')
                            ->nullable()
                            ->default(now()),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Author')
                            ->default(Auth::id())
                            ->required(),
                    ]),
            ]);
    }
}
