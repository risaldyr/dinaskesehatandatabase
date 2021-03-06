<?php

namespace App\Http\Controllers;
use App\User;
use App\User_Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViolationController extends Controller
{
    public function violationOff(Request $request, $id)
    {
        $user = User::find($id);


            //mengambil data user
        $idUser = $user->id;
        $idViolation = $user->violations->last()->id;
        $violation = User_Violation::where([
            ['user_id', $idUser],
            ['id', $idViolation]
        ])->first();

             // mengganti on to off
        $violation->keterangan = 'off';
        $violation->violation_at = $violation->created_at;
        $violation->note = $request->note;

        if ($violation->save()) {
            // selesai
            return response()->json('Berhasil', 202);
        }
    }

    public function showAllViolation()
    {
        // $violation = User::with(['violations'])->get();
        // return response()->json($violation);
        return response()->json(User_Violation::all());
    }
    public function showViolationsUser($id)
    {
        $user = User::find($id);

        $shows = $user->violations()->get();

        foreach ($shows as $show) {
            $data[] = [
                'name' => $show->nama,
                'keterangan' => $show->keterangan,
                'violation_at' => $show->violation_at,
                'note' => $show->note,
                'violation_id' => $show->id
            ];
        }
        return response()->json($data);
    }
}
