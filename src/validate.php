<?php
declare(strict_types=1);

function validate_required(string $v): bool
{
    // TODO: return true when $v is not empty after trimming
    return false;
}

function validate_email(string $v): bool
{
    // TODO: return true when $v is a valid email address
    return false;
}

function validate_length(string $v, int $min, int $max): bool
{
    // TODO: return true when mb_strlen($v) is within [$min, $max]
    return false;
}
