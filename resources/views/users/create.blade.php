<x-layout tittle="Criar usuario">
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Criar administrador</h2>
                                    <p class="text-white-50 mb-5">Por favor entre com seu login e senha!</p>
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" />
                                        <label class="form-label" for="nome">Nome</label>
                                    </div>
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" />
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <input type="radio" id="client" name="usuario" value="client">
                                        <label for="html">Client</label><br>
                                        <input type="radio" id="admin" name="usuario" value="admin">
                                        <label for="admin">Admin</label><br>
                                    </div>

                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Criar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </form>
</x-layout>