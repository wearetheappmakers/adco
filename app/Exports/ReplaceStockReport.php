<?php

namespace App\Exports;

use App\StockChild;
use App\Product;
use App\Category;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReplaceStockReport implements FromCollection,WithHeadings
{
    private $param;
    public function __construct($param)
    {
        $this->param = $param;
    }

    public function headings(): array
    {
        return [
            'branch',
            'category',
            'product',
            'price',
            'return_serial',
            'replace_serial'       
        ];
    }

    public function collection()
    {
        if($this->param['from_date'] && $this->param['to_date'])
        {
            $from = date('Y-m-d', strtotime($this->param['from_date']));
            $to = date('Y-m-d', strtotime($this->param['to_date']));

            $data = StockChild::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->where('return_id',1)->get();
            foreach($data as $key=>$value)
            {
                $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');
                unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
            }

            if(isset($this->param['branch_id']))
            {
                $data = StockChild::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->where('user_id',$this->param['branch_id'])->where('return_id',1)->get();
                foreach($data as $key=>$value)
                {
                    $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                    $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                    $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                    $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');
                    unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
                }
            }

            if($this->param['category_id'])
            {
                $data = StockChild::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->where('category_id',$this->param['category_id'])->where('return_id',1)->get();
                foreach($data as $key=>$value)
                {
                    $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                    $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                    $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                    $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');
                    unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
                }
            }

            if($this->param['product_id'])
            {
                $data = StockChild::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->where('product_id',$this->param['product_id'])->where('return_id',1)->get();
                foreach($data as $key=>$value)
                {
                    $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                    $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                    $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                    $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');
                    unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
                }
            }
        }elseif(isset($this->param['branch_id']))
        {
            $data = StockChild::where('user_id',$this->param['branch_id'])->where('return_id',1)->get();
            foreach($data as $key=>$value)
            {
                $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                 $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');
                unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
            }
        }
        elseif($this->param['category_id'])
        {
            $data = StockChild::where('category_id',$this->param['category_id'])->where('return_id',1)->get();
            foreach($data as $key=>$value)
            {
                $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                 $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');
                unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
            }
        }
        elseif($this->param['product_id'])
        {
            $data = StockChild::where('product_id',$this->param['product_id'])->where('return_id',1)->get();
            foreach($data as $key=>$value)
            {
                $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                 $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');
                unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
            }
        }elseif($this->param['from_date'] && $this->param['to_date'])
        {
            $from = date('Y-m-d', strtotime($this->param['from_date']));
            $to = date('Y-m-d', strtotime($this->param['to_date']));

            $data = StockChild::whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->where('return_id',1)->get();
            foreach($data as $key=>$value)
            {
                $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                 $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');
                unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
            }
        }else{
            $data = StockChild::where('return_id',1)->get();
            foreach($data as $key=>$value)
            {

                $data[$key]['user_id'] = User::where('id',$value->user_id)->value('name');
                $data[$key]['category_id'] = Category::where('id',$value->category_id)->value('name');
                $data[$key]['product_id'] = Product::where('id',$value->product_id)->value('name');
                $data[$key]['replaced'] = StockChild::where('id',$value->replaced)->value('serial_no');

                unset($data[$key]['id'],$data[$key]['created_at'],$data[$key]['updated_at'],$data[$key]['used'],$data[$key]['stock_id'],$data[$key]['return_id']);
            }
        }
        return $data;
    }
}
