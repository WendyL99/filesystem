<?php

namespace App\Imports;

use App\Admin\Models\FileBasics;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FilesImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //$row 是每一行的数据
        return new FileBasics([
            'status' => $row[1],
            'cname' => $row[2],
            'ename' => $row[3],
            'ID_CARD' => $row[4],
            'sex' => $row[5],
            'birthdate' => $row[6],
            'hiredate' => $row[7],
            'department' => $row[8],
            'position' => $row[9],
            'position_level' => $row[10],
            'marital_status' => $row[11],
            'has_children' => $row[12],
        ]);
    }

    /**
     * 从第几行开始处理数据（即不处理标题）
     * @return int
     */
    public function startRow(): int
    {
        // TODO: Implement startRow() method.

        return 2;
    }
}
