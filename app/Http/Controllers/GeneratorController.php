<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    public function makePassword(Request $request)
    {
        // валидация
        $this->validate($request, [
            'lenght' => 'numeric | integer | required',
        ]);

        // берем длину пароля
        $lenght = $request->lenght;

        // // строка чисел
        // $str_1 = "0123456789";

        // // строка прописных букв
        // $str_2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // // строка строчных букв
        // $str_3 = "abcdefghijklmnopqrstuvwxyz";

        // массив символов
        $pass_arr = [];

        // берем 3 случайных цифры
        for ($i = 0; $i < 3; $i++) {
            // записываем в массив
            $pass_arr[] = chr(mt_rand(48, 57));
        }

        // берем 2 случайных ПРописных буквы
        for ($i = 0; $i < 2; $i++) {
            // записываем в массив
            $pass_arr[] = chr(mt_rand(65, 90));
        }

        // берем остальные строчные буквы
        for ($i = 0; $i < ($lenght - 5); $i++) {
            // записываем в массив
            $pass_arr[] = chr(mt_rand(97, 122));
        }

        // перемешаем массив
        shuffle($pass_arr);

        // объединяем символы в строку
        $pass = implode('', $pass_arr);

        return view('generators.pass', compact('pass'));
    }

    public function makePin(Request $request)
    {
        // массив символов
        $pass_arr = [];

        // берем 4 случайных цифры
        for ($i = 0; $i < 4; $i++) {
            // записываем в массив
            $pass_arr[] = chr(mt_rand(48, 57));
        }

        // объединяем символы в строку
        $pin = implode('', $pass_arr);

        return view('generators.pin', compact('pin'));

    }
}
