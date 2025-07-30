<?php

namespace App\Exceptions;

use Exception;

class RequestValidationException extends Exception
{
  protected array $errors;

  public function __construct(
    array $errors,
    string $message = 'Los datos enviados no son válidos',
    int $code = 422,
    ?\Throwable $previous = null

  ) {
    parent::__construct($message, $code, $previous);
    $this->errors = $errors;
  }

  public function getErrors(): array
  {
    return $this->errors;
  }

  public function render($request)
  {
    return response()->json([
      'success' => false,
      'message' => $this->getErrors(),
      'error' => true
    ], $this->getCode());
  }
}
