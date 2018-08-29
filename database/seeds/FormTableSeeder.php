<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array('table' => array(
            'users' => array(
                'id' => array(
                    'protected' => true
                ),
                'first_name'=> array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"string":null,"max":"100"}',
                    'protected' => false
                ),
                'last_name'=> array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"string":null,"max":"100"}',
                    'protected' => false
                ),
                'email'=> array(
                    'type' => 'email',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"email":null}',
                    'aria_described_by' => 'emailHelp',
                    'protected' => false
                ),
                'password'=> array(
                    'protected' => true
                ),
                'status'=> array(
                    'type' => 'select',
                    'attribute' => '{"required":null}',
                    'list' => '{"1":"active","0":"inactive"}',
                    'protected' => false
                ),
                'remember_token'=> array(
                    'protected' => true
                ),
                'created_at'=> array(
                    'protected' => true
                ),
                'updated_at'=> array(
                    'protected' => true
                ),
                '_token' => array(
                    'protected' => true
                )
            ),
            'experience' => array(
                'id' => array(
                    'protected' => true
                ),
                'img_path' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"string","max":"100"}',
                    'protected' => false
                ),
                'title' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"string":null,"max":"100"}',
                    'protected' => false
                ),
                'company_name' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => 'text',
                    'protected' => false
                ),
                'start_date' => array(
                    'type' => 'date',
                    'attribute' => '{"required":null}',
                    'validation' => '{"date_format":"m/d/Y"}',
                    'protected' => false
                ),
                'end_date' => array(
                    'type' => 'date',
                    'attribute' => '{"required":null}',
                    'validation' => '{"date_format":"m/d/Y"}',
                    'protected' => false
                ),
                'city' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"string","max":"100"}',
                    'protected' => false
                ),
                'state' => array(
                    'type' => 'select',
                    'attribute' => '{"required":null}',
                    'list' => '{"AL":"Alabama","AK":"Alaska","AZ":"Arizona","AR":"Arkansas","CA":"California","CO":"Colorado","CT":"Connecticut","DE":"Delaware","DC":"District Of Columbia","FL":"Florida","GA":"Georgia","HI":"Hawaii","ID":"Idaho","IL":"Illinois","IN":"Indiana","IA":"Iowa","KS":"Kansas","KY":"Kentucky","LA":"Louisiana","ME":"Maine","MD":"Maryland","MA":"Massachusetts","MI":"Michigan","MN":"Minnesota","MS":"Mississippi","MO":"Missouri","MT":"Montana","NE":"Nebraska","NV":"Nevada","NH":"New Hampshire","NJ":"New Jersey","NM":"New Mexico","NY":"New York","NC":"North Carolina","ND":"North Dakota","OH":"Ohio","OK":"Oklahoma","OR":"Oregon","PA":"Pennsylvania","RI":"Rhode Island","SC":"South Carolina","SD":"South Dakota","TN":"Tennessee","TX":"Texas","UT":"Utah","VT":"Vermont","VA":"Virginia","WA":"Washington","WV":"West Virginia","WI":"Wisconsin","WY":"Wyoming"}',
                    'validation' => '{"string","max":"100"}',
                    'protected' => false
                ),
                'description' => array(
                    'type' => 'textarea',
                    'attribute' => '{"rows":"5","required":null}',
                    'validation' => '{"string":null,"max":"65535"}',
                    'protected' => false
                ),
                'tasks' => array(
                    'type' => 'text',
                    'list' => 'json',
                    'validation' => '{"string":null,"max":"65535"}',
                    'protected' => false
                ),
                'status' => array(
                    'type' => 'radio',
                    'list' => '{"active":"active","inactive":"inactive"}',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"string":null,"max":"50"}',
                    'protected' => false
                ),
                '_token' => array(
                    'protected' => true
                )
            ),
            'skill' => array(
                'id' => array(
                    'protected' => true
                ),
                'user_id' => array(
                    'protected' => true
                ),
                'img_path' => array(
                    'type' => 'url',
                    'attribute' => '{"required":null}',
                    'validation' => '{"string":null,"max":"100"}',
                    'protected' => false
                ),
                'title' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"string","max":"50"}',
                    'protected' => false
                ),
                'duration' => array(
                    'type' => "number",
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"numeric":null}',
                    'protected' => false
                ),
                'tasks' => array(
                    'type' => 'text',
                    'list' => 'json',
                    'validation' => '{"string":null,"max":"65535"}',
                    'protected' => false
                ),
                'status' => array(
                    'type' => 'radio',
                    'list' => '{"active":"active","inactive":"inactive"}',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"string":null,"max":"50"}',
                    'protected' => false
                ),
                'created_at' => array(
                    'protected' => true
                ),
                'updated_at' => array(
                    'protected' => true
                ),
                '_token' => array(
                    'protected' => true
                )
            ),
            'user_info' => array(
                'id' => array(
                    'protected' => true
                ),
                'user_id' => array(
                    'protected' => true
                ),
                'building_number' => array(
                    'type' => 'number',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"numeric":null}',
                    'protected' => false
                ),
                'address' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null}',
                    'protected' => false
                ),
                'city' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null}',
                    'protected' => false
                ),
                'state' => array(
                    'type' => 'select',
                    'list' => '{"AL":"Alabama","AK":"Alaska","AZ":"Arizona","AR":"Arkansas","CA":"California","CO":"Colorado","CT":"Connecticut","DE":"Delaware","DC":"District Of Columbia","FL":"Florida","GA":"Georgia","HI":"Hawaii","ID":"Idaho","IL":"Illinois","IN":"Indiana","IA":"Iowa","KS":"Kansas","KY":"Kentucky","LA":"Louisiana","ME":"Maine","MD":"Maryland","MA":"Massachusetts","MI":"Michigan","MN":"Minnesota","MS":"Mississippi","MO":"Missouri","MT":"Montana","NE":"Nebraska","NV":"Nevada","NH":"New Hampshire","NJ":"New Jersey","NM":"New Mexico","NY":"New York","NC":"North Carolina","ND":"North Dakota","OH":"Ohio","OK":"Oklahoma","OR":"Oregon","PA":"Pennsylvania","RI":"Rhode Island","SC":"South Carolina","SD":"South Dakota","TN":"Tennessee","TX":"Texas","UT":"Utah","VT":"Vermont","VA":"Virginia","WA":"Washington","WV":"West Virginia","WI":"Wisconsin","WY":"Wyoming"}',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"max":"2"}',
                    'protected' => false
                ),
                'zip_code' => array(
                    'type' => 'number',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"numeric":null}',
                    'protected' => false
                ),
                'zip_code_ext' => array(
                    'type' => 'number',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null,"numeric":null}',
                    'protected' => false
                ),
                'home_phone' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null}',
                    'protected' => false
                ),
                'office_phone' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null}',
                    'protected' => false
                ),
                'mobile_phone' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required":null}',
                    'protected' => false
                ),
                'title' => array(
                    'type' => 'text',
                    'attribute' => '{"required":null}',
                    'validation' => '{"required","max":"100"}',
                    'protected' => false
                ),
                'bio' => array(
                    'type' => 'textarea',
                    'attribute' => '{"rows":"5","required":null}',
                    'validation' => '{"string":null,"max":"65535"}',
                    'protected' => false
                ),
                'gender' => array(
                    'type' => 'radio',
                    'list' => '{"M":"male","F":"female","O":"other"}',
                    'attribute' => '{"required":null}',
                    'validation' => '{"string":null,"max":"1"}',
                    'protected' => false
                ),
                '_token' => array(
                    'protected' => true
                )
            )
        ));

        /* COLUMN
            'type' => ,
            'list' => ,
            'attribute' => ,
            'validation' => ,
            'aria_described_by' => ,
            'protected' =>
         */

        foreach ($data['table'] as $table => $columns)
        {
            foreach ($columns as $column => $key_value)
            {
                DB::table('form')->insert([
                    'table' => $table,
                    'column' => $column,
                ]);

                foreach ($key_value as $key => $value)
                {
                    DB::table('form')
                        ->where([['table', '=', $table],['column', '=', $column]])
                        ->update([$key => $value]);
                }
            }
        }
    }
}