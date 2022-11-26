<?php

class Sale extends Model
{
  protected $table = 'sales';

  protected $allowed_column = [
    'barcode',
    'recipt_no',
    'description',
    'qty',
    'amount',
    'total',
    'date',
    'user_id'
  ];
}
