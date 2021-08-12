<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;



/**
 * @OA\Get(
 *      path="/api/customer",
 *      operationId="getCustomersList",
 *      tags={"Customers"},
 *      summary="Get list of customers",
 *      description="Returns list of customers",
 *      @OA\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *       @OA\Response(response=400, description="Bad request"),
 *       security={
 *           {"api_key_security_example": {}}
 *       }
 *     )
 *
 * Returns list of projects
 */

 /**
 * @OA\Get(
 *      path="/api/customer/{email}",
 *      operationId="getCustomerByEmail",
 *      tags={"Customers"},
 *      summary="Get customer information",
 *      description="Returns customer data",
 *      @OA\Parameter(
 *          name="email",
 *          description="Customer email",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=404, description="Resource Not Found"),
 *      security={
 *         {
 *             "oauth2_security_example": {"write:projects", "read:projects"}
 *         }
 *     },
 * )
 */

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers =  Customer::all();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'mobile' => 'required'
        ]);

        $customers =  Customer::create($request->all());
        return response()->json($customers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        $customer = Customer::where('email', $email)->firstOrFail();
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {       

        // echo $email;
        // echo "<br>";
        // print_r($request->all());

        $customer = Customer::where('email', $email)->update(['firstname' => $request->firstname, 'lastname' => $request->lastname, 'phone' => $request->phone, 'mobile' => $request->mobile]);
        if($customer){
            // return response()->json(Customer::all());
            return response()->json([
                'message'=>'Customer Updated Successfully!!',
                'customer'=>Customer::all()
            ]);
        }


        // return $customer;
        // ['firstname' => $request->firstname, 'lastname' => $request->lastname, 'phone' => $request->phone, 'mobile' => $request->mobile]
    }

    // public function update(Request $request, Customer $customer)
    // {
    //     $customer->fill($request->post())->save();
    //     return response()->json([
    //         'message'=>'Customer Updated Successfully!!',
    //         'customer'=>$customer
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Search data.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Customer::where('email', 'like', '%'.$name.'%')->get();
    }
}
