<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Requests\LeaveRequest;
use App\Leave;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LeaveController extends Controller
{
    public function create(LeaveRequest $request, JWTAuth $JWTAuth)
    {
        // return $user = auth()->user();
        $leave = new Leave($request->all());
        $leave->user_id = auth()->user()->id;

        if(!$leave->save()) {
            throw new HttpException(500);
        }

        if ($leave->save()) {
            return response()->json([
                'status' => 'ok',
                'data' => $leave
            ], 201);
        }
    }

    public function update(LeaveRequest $request, $id)
    {
        $leave = Leave::where('id', '=', $id)->first();
        $leave->status = $request->get('status');
        $leave->save();
        return response()->json([
            'status' => 'ok',
            'data' => $leave
        ], 201);
    }

    public function delete($id) {
        $leave = Leave::where('id', '=', $id)->first();
        $leave->delete();
        return response()->json([
            'status' => 'ok'
        ], 201);
    }

    public function view($id) {
        $leave = Leave::where('id', '=', $id)->first();
        return response()->json([
            'status' => 'ok',
            'data' => $leave
        ], 201);
    }

    public function index() {
        $leaves = Leave::all();
        return response()->json([
            'status' => 'ok',
            'data' => $leaves
        ], 201);
    }
}
