<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Language extends Model
{
    protected $fillable = [
        'name'
    ];
    protected $SWAHILI = 'Swahili';


    //SCOPE
    public function scopeTerm($q, $term)
    {
        $language = Session::get('language');
        if ($language == $this->SWAHILI) {
            return $this->dictionary[$language][$term];
        } else {
            return $term;
        }
    }

    //Dictionary
    protected $dictionary = [
        'Swahili' => [
            'Dashboard' => 'Dashboard',
            'Sale' => 'Mauzo',
            'New Sale' => 'Mauzo Mapya',
            'View Sales' => 'Angalia Mauzo',
            'Customers' => 'Wateja',
            'Products' => 'Bidhaa',
            'Inventory' => 'Stoo',
            'Expenses' => 'Matumizi',
            'Users' => 'Watumiaji',
            'Extra Income' => 'Kipato cha Nyongeza',
            'Report' => 'Taarifa',
            'Configure' => 'Pangilia',
            'Log Out' => 'Ondoka',
            'Search'=>'Tafuta',
            'Total'=>'Jumla',
            'showing'=>'onyesha',
            'View Receipt'=>'Angalia Risiti',
            'Add'=>'Ongeza',
            'Customer'=>'Mteja',
            'Name'=>'Jina',
            'Amount'=>'Kiasi',
            'Spent'=>'Kilichotumika',
            'Visit Count'=>'Kanunua Mara Ngapi',
            'Debt'=>'Deni'
        ],
    ];
}
