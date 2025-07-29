<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
  public function __construct(
    string $message = "Credenciales incorrectas",
    int $code = 400,
    ?\Throwable $previous = null
  ) {
    parent::__construct($message, $code, $previous);
  }

  public function render()
  {
    return response()->json([
      'success' => false,
      'message' => $this->getMessage(),
      'error' => true
    ], $this->getCode());
  }
}
