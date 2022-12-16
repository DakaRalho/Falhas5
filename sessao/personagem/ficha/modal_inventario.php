<!-- Modal ARMAS -->
<div class="modal fade" id="editinv" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-black border-light">
            <div class="modal-header">
                <span class="fs-4 modal-title">Editar Inventário</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <span class="text-center fs-4"><?= $espacosusados ?>/<?= $invmax ?></span>
                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editpesoinv" title="Adicionar Arma">
                        <i class="fas fa-pencil"></i>
                    </button>
                </div>

				<h3 class="text-center">Armas</h3>
				<table class="table table-sm bg-black text-white table-borderless font2 mb-5 border border-light">
					<thead>
					<tr>
						<th>
							<button type="button" data-bs-toggle="modal" data-bs-target="#addarma" class="btn btn-sm text-success"
									title="Adicionar Arma">
								<i class="fa-solid fa-square-plus"></i>
							</button>
						</th>
						<th scope="col">Nome</th>
						<th scope="col">Tipo</th>
						<th scope="col">Ataque</th>
						<th scope="col">Alcance</th>
						<th scope="col">Dano</th>
						<th scope="col">Crítico</th>
						<th scope="col">Margem</th>
						<th scope="col">Recarga</th>
						<th scope="col">Especial</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($s[1] as $row): ?>
						<tr id="armaid<?= $row["id"] ?>">
							<td>
								<button type="button" data-bs-toggle="modal" data-bs-target="#editarma"
										onclick="edit('arma',<?= $row["id"] ?>)" class="btn btn-sm text-warning">
									<i class="fa-regular fa-pencil"></i>
								</button>
							</td>
							<td class="arma"><?= $row['arma']; ?></td>
							<td class="tipo"><?= $row['tipo']; ?></td>
							<td class="ataque"><?= $row['ataque']; ?></td>
							<td class="alcance"><?= $row['alcance']; ?></td>
							<td class="dano"><?= $row['dano']; ?></td>
							<td class="critico"><?= $row['critico']; ?></td>
							<td class="margem"><?= $row['margem']; ?></td>
							<td class="recarga"><?= $row['recarga']; ?></td>
							<td class="especial"><?= $row['especial']; ?></td>
							<td>
								<button type="button" onclick="deletar(<?= $row["id"] ?>, '<?= $row["arma"] ?>', 'delarma')" title="Editar Arma" class="btn btn-sm text-danger">
									<i class="fa-regular fa-trash"></i>
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
                <h3 class="text-center">Itens</h3>
                <table class="table table-sm bg-black text-white table-borderless font2 mb-3 border border-light">
                    <thead>
                    <tr>
                        <th>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#additem" class="btn btn-sm text-success"
                                    title="Adicionar Item">
                                <i class="fa-regular fa-square-plus"></i>
                            </button>
                        </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Espaços</th>
                        <th scope="col">Categoria</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($s[4] as $row): ?>
                        <tr id="itemid<?= $row["id"] ?>">
                            <th>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#edititem"
                                        onclick="edititem(<?= $row["id"]; ?>)" class="btn btn-sm text-warning">
                                    <i class="fa-regular fa-pencil"></i>
                                </button>
                            </th>
                            <th class="nome"><?= $row['nome']; ?></th>
                            <td class="desc"><?= $row['descricao']; ?></td>
                            <td class="espaco"><?= $row['espaco']; ?></td>
                            <td class="prestigio"><?= $row['prestigio']; ?></td>
                            <td>
                                <button type="button" onclick="deletar(<?= $row["id"]; ?>,'<?= $row['nome'] ?>','delitem')" title="Deletar <?= $row['nome'] ?>" class="btn btn-sm text-danger">
                                    <i class="fa-regular fa-trash"></i>
                                </button>
                            </td>
                        </tr>
					<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal EDITAR ARMA -->
<form class="modal fade" id="editarma" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-black border-light">
            <div class="modal-header">
                <span class="fs-4 modal-title">Editar Arma</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="cleanedit()"></button>
            </div>
            <div class="modal-body">
                <div class="m-2 text-center">
                    <img style="max-width: 200px" src="" alt="Imagem da Arma">
                </div>
                <div class="row g-2">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-floating">
                                <input class="foto-perfil form-control form-control-dark" id="arma_input" name="foto" type="url" />
                                <label>Foto</label>
                            </label>
                            <label class="btn btn-outline-light border-dashed">
                                <span id="arma_label" class="">Ou Selecione uma foto</span>
                                <label class="progress" style="display: none;">
                                    <label class="progress-bar" id="arma_progress" role="progressbar"></label>
                                </label>
                                <input type="file" name="video" accept=".png,.gif,.jpeg,.jpg,.webp" onchange="uploadFile('arma_',this,'<?= $fichat ?>','arma',()=>editupdatefoto($('#arma_input').val(),'#editarma img'))" hidden/>
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-floating">
                            <input name="nome" maxlength="<?= $limite_nome_inv ?>" placeholder="Nome da Arma" type="text" class="form-control  form-control-dark" required/>
                            <label>Nome</label>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-floating">
                            <input name="tipo" type="text" placeholder="Tipo de Dano" maxlength="<?= $Arma_tipo ?>" class="form-control  form-control-dark"/>
                            <label>Tipo</label>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-floating">
                            <input name="ataque" type="text" placeholder="1d20" maxlength="<?= $Arma_ataq ?>" class="form-control  form-control-dark"/>
                            <label>Ataque</label>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-floating">
                            <input name="alcance" type="text" placeholder="Alcance da Arma" maxlength="<?= $Arma_alca ?>" class="form-control  form-control-dark"/>
                            <label>Alcance</label>
                        </label>
                    </div>
                    <div class="col-4">
                        <label class="form-floating">
                            <input name="dano" placeholder="Dano normal da arma" type="text" maxlength="<?= $Arma_dano ?>" class="form-control form-control-dark"/>
                            <label>Dano</label>
                        </label>
                    </div>
                    <div class="col-4">
                        <label class="form-floating">
                            <input name="critico" type="text" maxlength="<?= $Arma_crit ?>" placeholder="2d4" class="form-control bg-transparent text-white"/>
                            <label>Crítico</label>
                        </label>
                    </div>
                    <div class="col-4">
                        <label class="form-floating">
                            <input name="margem" placeholder="Margem de crítico da arma" type="number" min="0" max="20" class="form-control  form-control-dark"/>
                            <label>Margem</label>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-floating">
                            <input name="recarga" placeholder="Recarga da arma" type="text" maxlength="<?= $Arma_reca ?>"
                                   class="form-control form-control-dark"/>
                            <label>Recarga</label>
                        </label>
                    </div>


                    <div class="col-6">
                        <label class="form-floating">
                            <input name="especial" type="text" placeholder="Especial da arma" maxlength="<?= $Arma_espe ?>" class="form-control form-control-dark"/>
                            <label>Especial</label>
                        </label>
                    </div>
                </div>
                <input type="hidden" name="did" value=""/>
                <input type="hidden" name="status" value="editarma"/>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success float-end w-100" data-bs-dismiss="modal">Salvar</button>
            </div>
        </div>
    </div>
</form>

<!-- Modal ADD ITEM -->
<div class="modal fade" id="additem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-black border-light">
            <form class="modal-body" method="post" autocomplete="off" id="formadditem">
                <div class="border-0 modal-header fs-1">Adicionar Item</div>
                <div class="row my-5 g-2">
                    <div class="col-12">
                        <div class="input-group">
                            <label for="anom" class="p-1 input-group-text border-light bg-black text-white border-end-0">Nome:</label>
                            <input id="anom" name="nome" type="text" maxlength="<?= $limite_nome_inv ?>" class="form-control border-start-0 border-light bg-black text-white"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group">
                            <label for="ades"
                                   class="p-1 input-group-text border-light bg-black text-white border-end-0">Descrição:</label>
                            <input id="ades" name="descricao" type="text" maxlength="<?= $Inv_desc ?>"
                                   class="form-control border-start-0 border-light bg-black text-white"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <label for="apes"
                                   class="p-1 input-group-text border-light bg-black text-white border-end-0">Peso/Espaço:</label>
                            <input id="apes" name="peso" min="-10" max="30" class="form-control border-start-0 border-light bg-black text-white"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <label for="apre"
                                   class="p-1 input-group-text border-light bg-black text-white border-end-0">Categoria:</label>
                            <input id="apre" name="prestigio" type="number" min="-50" max="50"
                                   class="form-control border-start-0 border-light bg-black text-white"/>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="status" value="additem"/>
                <div class="clearfix mx-5">
                    <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal"
                            onclick="cleanedit()">Cancelar
                    </button>
                    <button type="submit" class="btn btn-success float-end" data-bs-dismiss="modal">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal EDITAR ITEM -->
<div class="modal fade" id="edititem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-black border-light">
            <form class="modal-body" method="post" autocomplete="off" id="formedititem">
                <div class="border-0 modal-header fs-1">Editar Item</div>
                <div class="row my-5 justify-content-center g2">
                    <div class="col-12">
                        <div class="input-group">
                            <label for="enom" class="p-1 input-group-text border-light bg-black text-white border-end-0">Nome:</label>
                            <input id="enom" name="nome" type="text" maxlength="<?= $limite_nome_inv ?>" class="form-control border-start-0 border-light bg-black text-white"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group">
                            <label for="edes"
                                   class="p-1 input-group-text border-light bg-black text-white border-end-0">Descrição:</label>
                            <input id="edes" name="descricao" type="text" maxlength="<?= $Inv_desc ?>"
                                   class="form-control border-start-0 border-light bg-black text-white"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <label for="epes"
                                   class="p-1 input-group-text border-light bg-black text-white border-end-0">Peso/Espaço:</label>
                            <input id="epes" name="peso" type="number" min="-50"
                                   class="form-control border-start-0 border-light bg-black text-white"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <label for="epre"
                                   class="p-1 input-group-text border-light bg-black text-white border-end-0">Categoria:</label>
                            <input id="epre" name="prestigio" type="number" max="50"
                                   class="form-control border-start-0 border-light bg-black text-white"/>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="did" value="" id="edititid"/>
                <input type="hidden" name="status" value="edititem"/>
                <div class="clearfix mx-5">
                    <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal"
                            onclick="cleanedit()">Cancelar
                    </button>
                    <button type="submit" class="btn btn-success float-end" data-bs-dismiss="modal">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal EDITAR ITEMpeso inv -->
<form class="modal fade" id="editpesoinv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-black border-light">
            <div class="modal-header">
                <span class="fs-4">Inventário</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="justify-content-center m-2">
                    <p>Deixe 1 para padrão</p>
                    <label class="input-group">
                        <span class="p-1 input-group-text border-light bg-black text-white border-end-0">Peso: </span>
                        <input name="peso" type="number" min="1" max="99" value="<?= $invmax ?>" class="form-control border-start-0 border-light bg-black text-white"/>
                    </label>
                </div>
                <input type="hidden" name="status" value="peso_inv"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success ms-auto" data-bs-dismiss="modal">Salvar</button>
            </div>
        </div>
    </div>
</form>


<!--------------------------ADD ARMAS---------------------------------------------------------------->
<form class="modal fade" id="addarma" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-black border-light">
            <div class="modal-header">
                <span>Adicionar Arma</span>
                <button type="button" class="btn-close-white btn-close" data-bs-dismiss="modal" onclick="cleanedit()"></button>
            </div>
            <div class="modal-body">

                <div class="m-2 text-center">
                    <img style="max-width: 200px" src="" alt="Imagem da Arma">
                </div>
                <div class="row m-2 g-2">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="form-floating">
                                <input class="foto-perfil form-control form-control-dark" id="aarma_input" name="foto" type="url" />
                                <label>Foto</label>
                            </label>
                            <label class="btn btn-outline-light border-dashed">
                                <span id="aarma_label" class="">Ou Selecione uma foto</span>
                                <label class="progress" style="display: none;">
                                    <label class="progress-bar" id="aarma_progress" role="progressbar"></label>
                                </label>
                                <input type="file" name="video" accept=".png,.gif,.jpeg,.jpg,.webp" onchange="uploadFile('aarma_',this,'<?= $fichat ?>','arma',()=>editupdatefoto($('#aarma_input').val(),'#addarma img'))" hidden/>
                            </label>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4">
                        <label class="form-floating">
                            <input name="nome" placeholder="Nome da Arma" maxlength="<?= $limite_nome_inv ?>" class="form-control form-control-dark" required />
                            <label>Nome</label>
                        </label>
                    </div>
                    <div class="col-6 col-lg-4">
                        <label class="form-floating">
                            <input name="tipo" placeholder="Tipo de dano da Arma" maxlength="<?= $Arma_tipo ?>" class="form-control form-control-dark"/>
                            <label>Tipo</label>
                        </label>
                    </div>
                    <div class="col-6 col-lg-4">
                        <label class="form-floating">
                            <input name="alcance" placeholder="Alcance da Arma" maxlength="<?= $Arma_alca ?>" class="form-control form-control-dark"/>
                            <label>Alcance</label>
                        </label>
                    </div>

                    <div class="col-6">
                        <label class="form-floating">
                            <input name="recarga" placeholder="Recarga da Arma" maxlength="<?= $Arma_reca ?>" class="form-control form-control-dark"/>
                            <label>Recarga</label>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="form-floating">
                            <input name="especial" placeholder="Especial da Arma" maxlength="<?= $Arma_espe ?>" class="form-control form-control-dark"/>
                            <label>Especial</label>
                        </label>
                    </div>
                    <div class="col-6 col-xl-4">
                        <label class="form-floating">
                            <input name="ataque" placeholder="Dado de ataque da Arma" maxlength="<?= $Arma_ataq ?>" class="form-control form-control-dark"/>
                            <label>Ataque</label>
                        </label>
                    </div>
                    <div class="col-12 col-sm-5 col-lg-6 col-xl-4">
                        <label class="form-floating">
                            <input name="dano" placeholder="Dano de ataque da Arma" maxlength="<?= $Arma_dano ?>" class="form-control form-control-dark"/>
                            <label>Dano</label>
                        </label>
                    </div>
                    <div class="col-7 col-sm-4 col-lg-8 col-xl-2">
                        <label class="form-floating">
                            <input name="critico" placeholder="Dano Crítico do ataque da Arma" maxlength="<?= $Arma_crit ?>" class="form-control form-control-dark"/>
                            <label>Crítico</label>
                        </label>
                    </div>
                    <div class="col-5 col-sm-3 col-lg-4 col-xl-2">
                        <label class="form-floating">
                            <input name="margem" placeholder="Margem do Crítico do ataque da Arma" type="number" min="0" max="20" class="form-control form-control-dark"/>
                            <label>Margem</label>
                        </label>
                    </div>
                </div>
                <hr>
                <label class="m-3 form-check form-switch">
                    <input class="form-check-input" type="checkbox" checked role="switch" id="addarmainvswitch" name="invtoo">
                    <label class="form-check-label" for="addarmainvswitch">Adicionar Ao inventario</label>
                </label>
                <div class="row m-2 g-2 addinv">
                    <div class="col-8 col-md-9 col-lg-10">
                        <label class="form-floating h-100">
                            <textarea name="desc" placeholder="Detalhes ou descrição" maxlength="<?= $Inv_desc ?>" class="form-control form-control-dark h-100"></textarea>
                            <label>Detalhes</label>
                        </label>
                    </div>
                    <div class="col">
                        <label class="form-floating">
                            <input name="peso" placeholder="Peso" type="number" min="-10" max="50" class="form-control form-control-dark" />
                            <label>Peso</label>
                        </label>
                        <hr>
                        <label  class="form-floating">
                            <input name="prestigio" placeholder="Categoria" type="number"  min="-10" max="50" class="form-control form-control-dark" />
                            <label>Categoria</label>
                        </label>
                    </div>
                </div>
                <input type="hidden" name="status" value="addarma"/>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success w-100">Salvar</button>
            </div>
        </div>
    </div>
</form>