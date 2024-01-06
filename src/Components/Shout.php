<?php

namespace Awcodes\Shout\Components;

use Awcodes\Shout\Components\Concerns\HasContent;
use Awcodes\Shout\Components\Concerns\HasIcon;
use Awcodes\Shout\Components\Concerns\HasType;
use Closure;
use Filament\Forms\Components\ViewField;
use Filament\Support\Concerns\HasColor;

class Shout extends ViewField
{
    use HasIcon;
    use HasColor;
    use HasType;
    use HasContent;

    protected string $view = 'shout::components.shout-field';

    protected bool $itemCenter = false;

    public function setUp(): void
    {
        parent::setUp();

        $this->hiddenLabel();
        $this->dehydrated(false);
        $this->type('info');
    }

    public function getColor(): string | array | null
    {
        $color = $this->evaluate($this->color);

        if (!$color) {
            return match ($this->getType()) {
                'success' => 'success',
                'warning' => 'warning',
                'danger' => 'danger',
                default => 'info',
            };
        }

        return $color;
    }

    public function getIcon(): string
    {
        $icon = $this->evaluate($this->icon);

        if (!$icon && $icon !== '') {
            return match ($this->getType()) {
                'success' => 'heroicon-o-check-circle',
                'warning' => 'heroicon-o-exclamation-triangle',
                'danger' => 'heroicon-o-x-circle',
                default => 'heroicon-o-information-circle',
            };
        }

        return $icon;
    }

    public function itemCenter(Closure | bool $itemCenter = false): static
    {
        $this->itemCenter = $itemCenter;

        return $this;
    }

    public function getItemCenter(): bool
    {
        return $this->evaluate($this->itemCenter);
    }
}
