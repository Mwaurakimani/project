<?php

namespace Database\Seeders;

use App\Models\User;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Reader\Exception\ReaderNotOpenedException;
use Illuminate\Database\Seeder;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class DatabaseSeeder extends Seeder
{
    private $path = './database/seeders/SeederFiles/seeder_file.xlsx';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->get_excel_document();
    }

    public function seed_users()
    {

        $file = file_get_contents($this->path . "/users.json");
        $data = json_decode($file);
        $users = $data->data;


        foreach ($users as $key => $user_properties) {
            $user_model = new User();

            foreach ($user_properties as $key => $value) {
                if ($key == 'password') {
                    $user_model->{$key} = bcrypt($value);
                    continue;
                }
                $user_model->{$key} = $value;
            }

            $user_model->save();
        }
    }

    public function get_excel_document()
    {
        $reader = ReaderEntityFactory::createXLSXReader();
        try {
            $reader->open($this->path);

            foreach ($reader->getSheetIterator() as $sheet) {
                $sheet_name = $sheet->getName();

                switch ($sheet_name) {
                    case "Users":
                        foreach ($sheet->getRowIterator() as $key => $row) {
                            if ($key != 1) {
                                $user = new User();

                                $exist = $user->where('email','like',$row->getCells()[1]->getValue())->get();



                                if(count($exist) == 0){
                                    $user->username = $row->getCells()[0]->getValue();
                                    $user->email = $row->getCells()[1]->getValue();
                                    $user->password = bcrypt($row->getCells()[2]->getValue());
                                    $user->phone = $row->getCells()[3]->getValue();
                                    $user->account_type = $row->getCells()[4]->getValue();
                                    $user->save();
                                }else{
                                    echo "exist";
                                    break;
                                }
                            }
                        }
                        break;
                    case 'Block':
                        dd("found Block");
                        break;
                    case 'Houses':
                        dd("found Houses");
                        break;
                    case 'Services':
                        dd("found Services");
                        break;
                    case 'Events':
                        dd("found Events");
                        break;
                    case 'Arrears':
                        dd("found Arrears");
                        break;
                }




            }

        } catch (IOException|ReaderNotOpenedException $e) {
            dd($e);
        }


        $reader->close();
    }
}
