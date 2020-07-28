<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subjectId', 'body', 'fromName', 'fromEmail', 'toEmail', 'addedOn'
    ];
    
    public function spamAnalizer() {
        $total = str_word_count($this->body, 0);
        
        if ($total > 0) {
            $words = [
                'viagra'        => 5,
                'oferta'        => 4,
                'ofertas'       => 4,
                'buy'           => 5,
                'contactanos'   => 3,
                'contáctanos'   => 3,
                'tarifas'       => 2,
                'stock'         => 1
            ];
            
            $total_score = 0;
            foreach ($words as $word => $score) {
                $total_score += substr_count(strtolower($this->body), $word) * $score;
            }
        
            $this->spamScore = $total_score / $total;
        }
    }
    
    public function isSpam() {
        return $this->spamScore > 2.5;
    }
}
