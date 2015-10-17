<?php

class ExcelController extends BaseController {

    public function showDefaultView()
    {
        return View::make("excel");
    }

	public function makeSheet()
	{
		$input = Input::get('name');

        $arr = [];

        for ($i = 0; $i < 10; $i++)
        {
            $arr[$i] = [];

            for ($j = 0; $j < 10; $j++)
            {
                if ($i == $j)
                {
                    $arr[$i][$j] = "lol";
                }
                else
                {
                    $arr[$i][$j] = "hi";
                }
            }
        }

        \Excel::create($input, function($excel) {

            global $input;

            $excel->setTitle("hello " . $input);

            $excel->sheet('Sheeeeet!', function($sheet) {
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('hurr,');
                });
                $sheet->cell('A2', function($cell) {
                    $cell->setValue('durr.');
                });
            });

        })->download('xls');

        // Won't work lol
        return View::make( "excel", [ "message" => "Did stuff " . $input . "!" ] );
	}

}
