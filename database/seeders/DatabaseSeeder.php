<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Deposit;
use App\Models\House;
use App\Models\Service;
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
                                    break;
                                }
                            }
                        }
                        break;
                    case 'Block':
                        foreach ($sheet->getRowIterator() as $key => $row) {
                            if ($key != 1) {
                                $block = new Block();

                                $exist = $block->where('name','like',$row->getCells()[1]->getValue())->get();

                                if(count($exist) == 0){
                                    $block->name = $row->getCells()[0]->getValue();
                                    $block->location = $row->getCells()[1]->getValue();
                                    $block->description = $row->getCells()[2]->getValue();

                                    $block->save();
                                }else{
                                    break;
                                }
                            }
                        }
                        break;
                    case 'Houses':
                        foreach ($sheet->getRowIterator() as $key => $row) {
                            if ($key != 1) {
                                $house = new House();

                                $exist = $house->where('title','like',$row->getCells()[1]->getValue())->get();

                                if(count($exist) == 0){
                                    $house->title = $row->getCells()[0]->getValue();
                                    $house->block_id = $row->getCells()[1]->getValue();
                                    $house->description = "description";
                                    $house->rent_amount = $row->getCells()[2]->getValue();
                                    $house->save();
                                }else{
                                    break;
                                }
                            }
                        }
                        break;
                    case 'Services':
                        foreach ($sheet->getRowIterator() as $key => $row) {
                            if ($key != 1) {

                                $service = new Service();

                                $exist = $service->where('name','like',$row->getCells()[1]->getValue())->get();




                                if(count($exist) == 0){
                                    $service->name = $row->getCells()[0]->getValue();
                                    $service->description = $row->getCells()[1]->getValue();
                                    $service->price = $row->getCells()[2]->getValue();

                                    $service->save();
                                }else{
                                    break;
                                }
                            }
                        }
                        break;
                    case 'Events':
                        dd("found Events");
                        break;
                    case 'Arrears':
                        dd("found Arrears");
                        break;
                    case 'Deposits':
                        foreach ($sheet->getRowIterator() as $key => $row) {
                            if ($key != 1) {
                                $deposit = new  Deposit();
                                $deposit->tenant_id = $row->getCells()[0]->getValue();
                                $deposit->agent_id = $row->getCells()[1]->getValue();
                                $deposit->amount = $row->getCells()[2]->getValue();
                                $deposit->save();
                            }
                        }
                        break;
                }
            }

        } catch (IOException|ReaderNotOpenedException $e) {
            dd($e);
        }


        $reader->close();
    }
}
