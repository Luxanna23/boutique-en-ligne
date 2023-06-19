<div id="filterDiv">
                    <a href="categories.php" class="resultParent">Tout les articles</a>
                    <?php
                    foreach ($result as $categorie) {
                        $categorieId = $categorie['idCat'];
                        $categorieNom = $categorie['titreCat']; ?>
                        <div class="categoryParentDiv" data-parent-id="<?= $categorieId; ?>">
                            <ul>
                                <li class="resultParent dropdown-toggle" id="<?= $categorieNom; ?>">
                                    <input type="radio" class="category" name="category" id="<?= $categorieId; ?>"><?= $categorieNom; ?>
                                </li>
                                <ul class="categoryChildDiv" id="categoryChildDiv<?= $categorieId; ?>" data-parent-id="<?= $categorieId; ?>">
                                    <?php
                                            $req2 = $bdd->prepare('SELECT * FROM `souscategorie` WHERE `id_parent` = ?');
                                            $req2->execute([$categorieId]);
                                            $result2 = $req2->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result2 as $Subcategorie) {
                                                $subCategorieId = $Subcategorie['id'];
                                                $subCategorieNom = $Subcategorie['titreSousCat']; ?>
                                        <li id="<?= $subCategorieNom; ?>">
                                            <input type="radio" class="subCategory" name="subCategory" id="<?= $subCategorieId; ?>">
                                            <?= $subCategorieNom; ?>
                                        </li>
                                    <?php
                                            }
                                    ?>
                                </ul>
                            </ul>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>