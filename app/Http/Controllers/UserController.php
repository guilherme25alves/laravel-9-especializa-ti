<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUpdateUserFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index(Request $request) 
    {
        // Opção filtrando apenas pelo nome
        //$users = $this->model->where('name', 'LIKE', "%{$request->search}%")->get();        

        // Opção com filtro por nome ou e-mail
        $users = $this->model->getUsers(search: $request->search ?? '');

        return view('users.index', compact('users'));
    }

    public function show($id) 
    {
        // $user = $this->model->where('id', $id)->first(); (Uma opção)

        if(!$user = $this->model->find($id))
            return redirect()->route('users.index');        
        
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if ($request->image) {
            /*
           // $data['image'] = $request->image->store('users'); /; Upload de forma mais simples

            // Recuperando a extensão do arquivo
            $extension = $request->image->getClientOriginalExtension();

           // Opção renomeando o nome do arquivo 
           $data['image'] = $request->image->storeAs('users', now() . ".{$extension}");
           */

           // Refatorando exemplo acima
           $imageUploaded = $request->image;
           
           // Recuperando a extensão do arquivo
           $extension = $imageUploaded->getClientOriginalExtension();

           // Opção renomeando o nome do arquivo 
           $data['image'] = $imageUploaded->storeAs('users', now() . ".{$extension}");
        }

        $this->model->create($data);

        return redirect()->route('users.index');
        
        // Uma alternativa para salvar
        //$user = new User;
        //$user->name = $request->name;
        //$user->email = $request->email;
        //$user->password = $request->password;
        //$user->save();
    }

    public function edit($id)
    {
        if(!$user = $this->model->find($id))
            return redirect()->route('users.index'); 
    
        return view('users.edit', compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        if(!$user = $this->model->find($id))
            return redirect()->route('users.index'); 
        
        $data = $request->only('name', 'email');

        if ($request->password)
            $data['password'] = bcrypt($request->password);

        if ($request->image) {
            // Deletar imagem antiga do usuário, caso ele persista uma nova no momento de atualizar o cadastro
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }

            $imageUploaded = $request->image;
           
            $extension = $imageUploaded->getClientOriginalExtension();

            $data['image'] = $imageUploaded->storeAs('users', now() . ".{$extension}");
        }


        $user->update($data);

        return redirect()->route('users.index');
    }

    public function delete($id)
    {
        if(!$user = $this->model->find($id))
            return redirect()->route('users.index'); 
    
        $user->delete();

        return redirect()->route('users.index');
    }
}
