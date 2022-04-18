<?php $this->layout("admin::layout", ["nav" => 3]); ?>

<!-- Usuários -->
<div class="container-xxl py-3">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-normal">Usuários</h5>
        <button
            class="btn btn-primary"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#user-modal"
            data-url="<?=$this->route("user.modal")?>">
                <i class="bi bi-person-plus-fill"></i> Novo
        </button>
    </div>
</div>

<div class="container-xxl px-0">
    <div class="ajax-response px-2"></div>
    <table class="table table-hover align-middle">
        <thead style="background-color: rgba(0,0,0,.03);">
            <tr>
                <th class="ps-3">Nome</th>
                <th>Email</th>
                <th style="width: 60px;"></th>
                <th class="pe-3" style="width: 60px;">
                </th>
            </tr>
        </thead>
        <tbody>
           <?php foreach ($users as $user) : ?>
            <tr>
                <td class="ps-3"><?=$user->name?></td>
                <td><?=$user->email?></td>
                <td>
                    <a 
                        class="btn btn-sm btn-secondary" 
                        href="" 
                        data-bs-toggle="modal" 
                        data-bs-target="#user-modal" 
                        data-url="<?=$this->route("user.modal", ["id" => $user->id])?>">
                            <i class="bi bi-eye-fill"></i>
                    </a>
                </td>
                <td>
                    <form action="<?=$this->route("user.delete", ["id" => $user->id])?>" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-sm btn-danger" type="submit">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </td>
            </tr>
           <?php endforeach;?>
        </tbody>
    </table>
</div>
<!-- Usuários -->

