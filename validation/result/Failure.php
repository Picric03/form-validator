<?php
namespace validation\result;

final class Failure implements Result
{
    public function __construct(string $reason)
    {
        $this->reason = $reason;
    }

    public function isValid(): bool 
    {
        return false;
    }

    public function getReason(): string
    {
        return $this->reason; 
    }
} 