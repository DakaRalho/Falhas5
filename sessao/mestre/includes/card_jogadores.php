<div class="col-md-6" id="player">
    <div class="card bg-black border-light h-100">
        <div class="card-header text-center">
            <div class="position-absolute end-0">
                <button class="btn text-success fa-lg" data-bs-toggle="modal" data-bs-target="#adicionar">
                    <i class="fa-regular fa-square-plus"></i>
                </button>
            </div>
            <h3 class="font6 m-0">Fichas Personagens</h3>
        </div>
        <div class="card-body p-0">
            <div class="row row-cols-lg-2 row-cols-xxl-3 row-cols-1 g-2 p-2" id="fichasperson">
                <?php
                foreach ($jogadores as $ficha) {

                    if ($ficha["peso_inv"] > 1) {
                        $invmax = $ficha["peso_inv"];
                    } else {
                        $invmax = pesoinv($rqs["forca"], $rqs["inteligencia"], $rqs["classe"], $rqs["trilha"], $rqs["origem"]);
                    }

                    $s = $con->query("Select SUM(espaco) AS pesototal From `inventario` where `id_ficha` = '" . $ficha["id"] . "';");
                    $ddinv = mysqli_fetch_array($s);
                    $espacosusados = $ddinv["pesototal"];
                    $origem = $ficha["origem"];

                    $classe = $ficha["classe"];
                    $trilha = $ficha["trilha"];
                    $patente = $ficha["patente"];


                    ?>
                    <div class="col">
                        <div class="card-body h-100 p-0" id="player<?= $ficha["id"] ?>">
                            <div class="card h-100 bg-black border-light">
                                <div class="card-header">
                                    <a class="card-title fs-5 text-decoration-none" href="./../personagem/?token=<?= $ficha["token"] ?>"><span class="font4 link-light"><?= $ficha["nome"] ?></span> <i class="text-light fa-solid fa-arrow-up-right-from-square"></i></a>
                                    <div class="float-end d-inline">
                                        <a class="btn btn-sm btn-outline-info" href="./../personagem/portrait/<?= ($id == 5887) ? "Espiral/" : '' ?>?token=<?= $ficha["token"] ?>"><i class="fa-solid fa-user"></i></a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="desvincular(<?= $ficha["id"] ?>)" title="Desvincular ficha"><i class="fa-solid fa-link-slash"></i></button>
                                    </div>
                                </div>
                                <div class="card-body border-0 text-center">
                                    <nav>
                                        <div class="nav nav-tabs" role="tablist">
                                            <button class="btn btn-sm btn-outline text-light active"
                                                    id="aba-principal-<?= $ficha["id"] ?>"
                                                    data-bs-target="#principal-<?= $ficha["id"] ?>"
                                                    aria-controls="nav-home" data-bs-toggle="tab" type="button"
                                                    role="tab" aria-selected="true">Principal
                                            </button>
                                            <button class="btn btn-sm btn-outline text-light"
                                                    id="aba-detalhes-<?= $ficha["id"] ?>"
                                                    data-bs-target="#detalhes-<?= $ficha["id"] ?>"
                                                    aria-controls="nav-profile" data-bs-toggle="tab" type="button"
                                                    role="tab" aria-selected="false">Detalhes
                                            </button>
                                            <button class="btn btn-sm btn-outline text-light"
                                                    id="aba-dados-<?= $ficha["id"] ?>"
                                                    data-bs-target="#dados-<?= $ficha["id"] ?>"
                                                    aria-controls="nav-contact" data-bs-toggle="tab" type="button"
                                                    role="tab" aria-selected="false">Dados
                                            </button>
                                            <button class="btn btn-sm btn-outline text-light"
                                                    id="aba-outros-<?= $ficha["id"] ?>"
                                                    data-bs-target="#outros-<?= $ficha["id"] ?>"
                                                    aria-controls="nav-disabled" data-bs-toggle="tab" type="button"
                                                    role="tab" aria-selected="false">Outros
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active principal"
                                             id="principal-<?= $ficha["id"] ?>" role="tabpanel"
                                             aria-labelledby="aba-principal-<?= $ficha["id"] ?>"
                                             tabindex="0">

                                            <div class="my-2">
                                                <strong>Vida: <?= $ficha["pva"] ?>/<?= $ficha["pv"] ?></strong>
                                                <div class="progress">
                                                    <div class="progress-bar bg-danger"
                                                         style="width: <?= ($ficha["pva"] / $ficha["pv"]) * 100; ?>%;"
                                                         role="progressbar" aria-valuenow="<?= $ficha["pva"] ?>"
                                                         aria-valuemin="0"
                                                         aria-valuemax="<?= $ficha["pva"] ?>"></div>
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <strong>Sanidade: <?= $ficha["sana"] ?>/<?= $ficha["san"] ?></strong>
                                                <div class="progress">
                                                    <div class="progress-bar bg-primary"
                                                         style="width: <?= ($ficha["sana"] / $ficha["san"]) * 100; ?>%;"
                                                         role="progressbar" aria-valuenow="<?= $ficha["sana"] ?>"
                                                         aria-valuemin="0"
                                                         aria-valuemax="<?= $ficha["san"] ?>"></div>
                                                </div>
                                            </div>
                                            <div class="my-2 row px-3">
                                                <strong class="col-6 p-0 text-start">PE: <?= $ficha["pe"] - $ficha["pea"]; ?>
                                                    /<?= $ficha["pe"]; ?></strong>
                                                <strong class="col-6 p-0 text-end">Peso: <?= $espacosusados ?: "0" ?>
                                                    /<?= $invmax ?></strong>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="detalhes-<?= $ficha["id"] ?>" role="tabpanel"
                                             aria-labelledby="aba-detalhes-<?= $ficha["id"] ?>" tabindex="0">
                                            <div class="my-2">
                                                <strong>Defesas</strong>
                                                <div class="row g-2 justify-content-center">
                                                    <?= $ficha["passiva"] ? '
                                                       <div class="col-auto">
                                                           <span class="form-control form-control-sm border-light text-light bg-black">Passiva: ' . $ficha["passiva"] . '</span>
                                                       </div>' : ''
                                                    ?>

                                                    <?= $ficha["esquiva"] ? '
                                                       <div class="col-auto">
                                                            <span class="form-control form-control-sm border-light text-light bg-black">Esquiva: ' . $ficha["esquiva"] . '</span>
                                                       </div>' : ''
                                                    ?>
                                                </div>
                                                <strong>Resistencia</strong>
                                                <div class="row g-1 justify-content-center">
                                                    <?= $ficha["balistica"] ? '<div class="col-auto">
                                                                <span class="form-control form-control-sm border-light text-light bg-black">Balística: ' . $ficha["balistica"] . '</span>
                                                            </div>' : '' ?>

                                                    <?= $ficha["fogo"] ? '
                                                        <div class="col-auto">
                                                            <span class="form-control form-control-sm border-light text-light bg-black">Fogo: ' . $ficha["fogo"] . '</span>
                                                        </div>' : ''
                                                    ?>

                                                    <?= $ficha["fisica"] ? '
                                                        <div class="col-auto">
                                                            <span class="form-control form-control-sm border-light text-light bg-black">Física: ' . $ficha["fisica"] . '</span>
                                                        </div>' : ''
                                                    ?>
                                                    <?= $ficha["insanidade"] ? '
                                                       <div class="col-auto">
                                                           <span class="form-control form-control-sm border-light text-light bg-black">Mental: ' . $ficha["insanidade"] . '</span>
                                                       </div>' : ''
                                                    ?>

                                                    <?= $ficha["morte"] ? '
                                                        <div class="col-auto">
                                                            <span class="form-control form-control-sm border-light text-light bg-black">Morte: ' . $ficha["morte"] . '</span>
                                                        </div>' : ''
                                                    ?>

                                                    <?= $ficha["conhecimento"] ? '
                                                        <div class="col-auto">
                                                            <span class="form-control form-control-sm border-light text-light bg-black">Conhecimento: ' . $ficha["conhecimento"] . '</span>
                                                        </div>' : ''
                                                    ?>
                                                    <?= $ficha["sangue"] ? '
                                                        <div class="col-auto">
                                                            <span class="form-control form-control-sm border-light text-light bg-black">Sangue: ' . $ficha["sangue"] . '</span>
                                                        </div>' : ''
                                                    ?>

                                                    <?= $ficha["energia"] ? '
                                                        <div class="col-auto">
                                                            <span class="form-control form-control-sm border-light text-light bg-black">Energia: ' . $ficha["energia"] . '</span>
                                                        </div>' : ''
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="dados-<?= $ficha["id"] ?>" role="tabpanel"
                                             aria-labelledby="aba-dados-<?= $ficha["id"] ?>" tabindex="0">
                                            <div class="m-2">
                                                <strong>Atributos</strong>
                                                <div class="row justify-content-center g-1">
                                                    <div class='col-auto'><span
                                                                class='form-control form-control-sm bg-black text-white'>FOR: <?= $ficha["forca"] ?></span>
                                                    </div>
                                                    <div class='col-auto'><span
                                                                class='form-control form-control-sm bg-black text-white'>AGI: <?= $ficha["agilidade"] ?></span>
                                                    </div>
                                                    <div class='col-auto'><span
                                                                class='form-control form-control-sm bg-black text-white'>INT: <?= $ficha["inteligencia"] ?></span>
                                                    </div>
                                                    <div class='col-auto'><span
                                                                class='form-control form-control-sm bg-black text-white'>PRE: <?= $ficha["presenca"] ?></span>
                                                    </div>
                                                    <div class='col-auto'><span
                                                                class='form-control form-control-sm bg-black text-white'>VIG: <?= $ficha["vigor"] ?></span>
                                                    </div>
                                                </div>
                                                <strong>Perícias</strong>
                                                <?php if ($ficha["acrobacia"] != 0 || $ficha["artes"] != 0 || $ficha["adestramento"] != 0 || $ficha["atletismo"] != 0 || $ficha["atualidade"] != 0 || $ficha["ciencia"] != 0 || $ficha["diplomacia"] != 0 || $ficha["enganacao"] != 0 || $ficha["fortitude"] != 0 || $ficha["furtividade"] != 0 || $ficha["iniciativa"] != 0 || $ficha["intimidacao"] != 0 || $ficha["intuicao"] != 0 || $ficha["investigacao"] != 0 || $ficha["luta"] != 0 || $ficha["medicina"] != 0 || $ficha["ocultismo"] != 0 || $ficha["percepcao"] != 0 || $ficha["pilotagem"] != 0 || $ficha["pontaria"] != 0 || $ficha["profissao"] != 0 || $ficha["reflexos"] != 0 || $ficha["religiao"] != 0 || $ficha["sobrevivencia"] != 0 || $ficha["tatica"] != 0 || $ficha["tecnologia"] != 0 || $ficha["vontade"] != 0) { ?>
                                                    <div class="row justify-content-center g-2">
                                                        <?= $ficha["acrobacias"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Acrobacia: +" . $ficha["acrobacias"] . "</span></div>" : "" ?>
                                                        <?= $ficha["adestramento"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Adestramento: +" . $ficha["adestramento"] . "</span></div>" : "" ?>
                                                        <?= $ficha["artes"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Artes: +" . $ficha["artes"] . "</span></div>" : "" ?>
                                                        <?= $ficha["atletismo"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Atletismo: +" . $ficha["atletismo"] . "</span></div>" : "" ?>
                                                        <?= $ficha["atualidade"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Atualidades: +" . $ficha["atualidade"] . "</span></div>" : "" ?>
                                                        <?= $ficha["ciencia"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Ciências: +" . $ficha["ciencia"] . "</span></div>" : "" ?>
                                                        <?= $ficha["crime"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Crime: +" . $ficha["crime"] . "</span></div>" : "" ?>
                                                        <?= $ficha["diplomacia"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Diplomacia: +" . $ficha["diplomacia"] . "</span></div>" : "" ?>
                                                        <?= $ficha["enganacao"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Enganação: +" . $ficha["enganacao"] . "</span></div>" : "" ?>
                                                        <?= $ficha["fortitude"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Fortitude: +" . $ficha["fortitude"] . "</span></div>" : "" ?>
                                                        <?= $ficha["furtividade"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Furtividade: +" . $ficha["furtividade"] . "</span></div>" : "" ?>
                                                        <?= $ficha["iniciativa"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Iniciativa: +" . $ficha["iniciativa"] . "</span></div>" : "" ?>
                                                        <?= $ficha["intimidacao"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Intimidação: +" . $ficha["intimidacao"] . "</span></div>" : "" ?>
                                                        <?= $ficha["intuicao"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Intuição: +" . $ficha["intuicao"] . "</span></div>" : "" ?>
                                                        <?= $ficha["investigacao"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Investigação: +" . $ficha["investigacao"] . "</span></div>" : "" ?>
                                                        <?= $ficha["luta"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Luta: +" . $ficha["luta"] . "</span></div>" : "" ?>
                                                        <?= $ficha["medicina"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Medicina: +" . $ficha["medicina"] . "</span></div>" : "" ?>
                                                        <?= $ficha["ocultismo"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Ocultismo: +" . $ficha["ocultismo"] . "</span></div>" : "" ?>
                                                        <?= $ficha["percepcao"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Percepção: +" . $ficha["percepcao"] . "</span></div>" : "" ?>
                                                        <?= $ficha["pilotagem"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Pilotagem: +" . $ficha["pilotagem"] . "</span></div>" : "" ?>
                                                        <?= $ficha["pontaria"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Pontaria: +" . $ficha["pontaria"] . "</span></div>" : "" ?>
                                                        <?= $ficha["profissao"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Profissão: +" . $ficha["profissao"] . "</span></div>" : "" ?>
                                                        <?= $ficha["reflexos"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Reflexos: +" . $ficha["reflexos"] . "</span></div>" : "" ?>
                                                        <?= $ficha["religiao"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Religião: +" . $ficha["religiao"] . "</span></div>" : "" ?>
                                                        <?= $ficha["sobrevivencia"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Sobrevivência: +" . $ficha["sobrevivencia"] . "</span></div>" : "" ?>
                                                        <?= $ficha["tatica"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Tática: +" . $ficha["tatica"] . "</span></div>" : "" ?>
                                                        <?= $ficha["tecnologia"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Tecnologia: +" . $ficha["tecnologia"] . "</span></div>" : "" ?>
                                                        <?= $ficha["vontade"] ? "<div class='col-auto'><span class='form-control form-control-sm bg-black text-white'>Vontade: +" . $ficha["vontade"] . "</span></div>" : "" ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="outros-<?= $ficha["id"] ?>" role="tabpanel"
                                             aria-labelledby="aba-outros-<?= $ficha["id"] ?>" tabindex="0">
                                            <div class="m-2">
                                                <strong>Outros</strong>
                                                <?= $ficha["idade"] ? "<span class='form-control form-control-sm m-1 bg-black text-white'>Idade: " . $ficha["idade"] . "</span>" : "" ?>
                                                <?= $ficha["local"] ? "<span class='form-control form-control-sm m-1 bg-black text-white'>" . $ficha["local"] . "</span>" : "" ?>
                                                <?= $ficha["origem"] ? "<span class='form-control form-control-sm m-1 bg-black text-white'>Origem: " . $origem . "</span>" : "" ?>
                                                <?= $ficha["classe"] ? "<span class='form-control form-control-sm m-1 bg-black text-white'>Classe: " . $classe . "</span>" : "" ?>
                                                <?= $ficha["trilha"] ? "<span class='form-control form-control-sm m-1 bg-black text-white'>Trilha: " . $trilha . "</span>" : "" ?>
                                                <?= $ficha["patente"] ? "<span class='form-control form-control-sm m-1 bg-black text-white'>Patente: " . $patente . "</span>" : "" ?>
                                                <?= $ficha["pp"] ? "<span class='form-control form-control-sm m-1 bg-black text-white'>P.P.: " . $ficha["pp"] . "</span>" : "" ?>
                                                <?= $ficha["nex"] ? "<span class='form-control form-control-sm m-1 bg-black text-white'>NEX: " . $ficha["nex"] . "%</span>" : "" ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>