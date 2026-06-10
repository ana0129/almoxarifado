<?php

namespace App\Filament\Resources\Produtos\Pages;

use App\Filament\Resources\Produtos\ProdutoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduto extends CreateRecord
{
    protected static string $resource = ProdutoResource::class;

    protected function beforeCreate(): void
      //Hook - Remover ou aumentar o estoque 
      {
          $movimento = $this->getRecord(); // Registro do movimento criado
          $produto = $movimento->produto; // Produto relacionado ao movimento
  
          if ($movimento->tipo === 'e') {
              // Entrada: Aumentar o estoque
              $produto->increment('estoque', $movimento->quantidade);
          } else {
              // Saída: Diminuir o estoque
              $produto->decrement('estoque', $movimento->quantidade);
          }
  
      }
  
  }
