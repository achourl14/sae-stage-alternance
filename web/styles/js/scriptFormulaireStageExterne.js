function submitValue(value) {
    document.getElementById('stage').value = value;
}
document.addEventListener("DOMContentLoaded", function() {
    var boutonStage = document.getElementById("buttonStage");
    var boutonAlternance = document.getElementById("buttonAlternance");

    boutonStage.addEventListener("click", function() {
        boutonStage.style.backgroundColor = "red";
        boutonStage.style.color = "black";
        boutonAlternance.style.backgroundColor = "white";
        boutonAlternance.style.color = "black";
        submitValue("Stage")
    });

    boutonAlternance.addEventListener("click", function() {
        boutonAlternance.style.backgroundColor = "black";
        boutonAlternance.style.color = "white";
        boutonStage.style.backgroundColor = "white";
        boutonStage.style.color = "red";
        submitValue("Alternance")
    });
});


function validateEmailAndShowMessage() {
    const emailInput = document.querySelector("#email");
    const messageElement = document.querySelector("#emailMessage");

    const isValid = validEmail(emailInput.value);

    if (emailInput.value === "") {
        showMessage(messageElement, "");
        return false;
    }


    if (isValid) {
        showMessage(messageElement, "");
        return true;
    } else {
        showMessage(messageElement, "Adresse mail non valide");
        return false;
    }
}

const validEmail = function (email) {
    const emailRegExp = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegExp.test(email);
};

function showMessage(element, message) {
    element.innerHTML = message;

    setTimeout(function() {
        element.innerHTML = "";
    }, 3000); // Le message disparaîtra après 3 secondes (3000 millisecondes)
}

function checkCodeINE() {
    return new Promise(function(resolve, reject) {
        var codeINE = document.getElementById('idEtudiantStage').value;

        // Vérifier si le champ est vide
        if (codeINE === "") {
            resolve(false);  // Champ vide, résoudre la promesse avec la valeur false
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    var etudiant = response.etudiant;

                    if (etudiant == null) {
                        showMessage(document.getElementById('codeINEMessage'), "Aucun compte associé à ce code INE");
                        resolve(false);  // Résoudre la promesse avec la valeur false
                    } else {
                        resolve(true);  // Résoudre la promesse avec la valeur true
                    }
                }
            }
        };

        xhr.open('POST', 'controleurFrontal.php?action=verifierEtudiantExistant', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('codeINE=' + codeINE);
    });
}



function checkNumMaitreStage() {
    return new Promise(function(resolve, reject) {
        var numMaitreStage = document.getElementById('numMaitreStage').value;

        if (numMaitreStage === "") {
            resolve(false);  // Champ vide, résoudre la promesse avec la valeur false
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    var maitreStage = response.maitreStage;

                    if (maitreStage == null) {
                        showMessage(document.getElementById('idMaitreMessage'), "Compte inexistant");
                        resolve(false);  // Résoudre la promesse avec la valeur false
                    } else {
                        resolve(true);  // Résoudre la promesse avec la valeur true
                    }
                }
            }
        };

        xhr.open('POST', 'controleurFrontal.php?action=verifierMaitreStageExistant', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('numMaitreStage=' + numMaitreStage);
    });
}

function checkIdTuteur() {
    return new Promise(function(resolve, reject) {
        var idTuteur = document.getElementById('idTuteur').value;

        if (idTuteur === "") {
            resolve(false);  // Champ vide, résoudre la promesse avec la valeur false
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var tuteur = response.tuteur;

                    if (tuteur == null) {
                        showMessage(document.getElementById('idTuteurMessage'), "Compte inexistant");
                        resolve(false);  // Résoudre la promesse avec la valeur false
                    } else {
                        resolve(true);  // Résoudre la promesse avec la valeur true
                    }
                }
            }
        };

        xhr.open('POST', 'controleurFrontal.php?action=verifierTuteurExistant', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('idTuteur=' + idTuteur);
    });
}

function checkDateValidite() {
    var dateDebut = document.getElementById('dateDebut').value;
    var dateFin = document.getElementById('dateFin').value;
    var codeINE = document.getElementById('idEtudiantStage').value;
    var stage = document.getElementById('stage').value;

    if (dateDebut === "" && dateFin === "") {
        return new Promise(function(resolve, reject) {
            resolve(false);  // Champ vide, résoudre la promesse avec la valeur false
        });
    }
    else {
        return new Promise(function (resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    console.log(xhr.responseText);
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        console.log(response);
                        var dateDebutIsValid = response.date;
                        var dateFinIsValid = response.date2;
                        var dateMessage = response.messageError;

                        console.log(dateDebutIsValid, dateFinIsValid, dateMessage);

                        if (!dateDebutIsValid) {
                            var errorMessageDebut = dateMessage != null ? dateMessage : "Dates de début invalides";
                            showMessage(document.getElementById('dateDebutMessage'), dateDebutIsValid ? "" : errorMessageDebut);
                            resolve(false);  // Résoudre la promesse avec la valeur false
                        } else if (!dateFinIsValid) {
                            var errorMessageFin = dateMessage != null ? dateMessage : "Dates de fin invalides";
                            showMessage(document.getElementById('dateFinMessage'), dateFinIsValid ? "" : errorMessageFin);
                            resolve(false);  // Résoudre la promesse avec la valeur false
                        } else {
                            showMessage(document.getElementById('dateDebutMessage'), "");
                            showMessage(document.getElementById('dateFinMessage'), "");
                            resolve(true);  // Résoudre la promesse avec la valeur true
                        }
                    }
                }
            };
            xhr.open('POST', 'controleurFrontal.php?action=verifierDate', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('&dateDebutStage=' + dateDebut + '&dateFinStage=' + dateFin + '&codeINE=' + codeINE + '&stage=' + stage);
        });
    }
}

    function checkChampsVide() {
        // Vérifier chaque champ du formulaire
        var entrepriseFields = ['idEntreprise', 'nomEntreprise', 'adresseEntreprise', 'telephoneEntreprise', 'email', 'codeAPE'];
        var stageFields = ['idEtudiantStage', 'numMaitreStage', 'idTuteur', 'dateDebut', 'dateFin', 'remuneration'];
        //balise pour communiquer le messsage d'erreur
            // Parcourir et vérifier les champs de l'entreprise
            for (var i = 0; i < entrepriseFields.length; i++) {
                if (document.getElementById(entrepriseFields[i]).value === "") {
                    return true; // Retourner true si un champ est vide
                }
            }

            // Parcourir et vérifier les champs de stage
            for (var j = 0; j < stageFields.length; j++) {
                if (document.getElementById(stageFields[j]).value === "") {
                    return true // Retourner true si un champ est vide
                }
            }

        // Si tous les champs sont remplis, retourner false
        return false;
    }

    function checkNumTelephone() {
        var telephoneMessage = document.getElementById('telephoneMessage');

        var telephoneField = document.getElementById('telephoneEntreprise').value;


        if (telephoneField.value === "") {
            return false;
        }
        else if (telephoneField.length !== 10 && telephoneField.length !== 0) {
            showMessage(telephoneMessage, "Numéro de téléphone invalide");
            return false;
        }
        return true;
    }

async function checkAll() {
    var codeINE = await checkCodeINE();
    var numMaitreStage = await checkNumMaitreStage();
    var idTuteur = await checkIdTuteur();
    var email = validateEmailAndShowMessage();
    var date = await checkDateValidite();
    var champsVide = checkChampsVide();
    var telephone = checkNumTelephone();


    if (codeINE && numMaitreStage && idTuteur && email && date && !champsVide && telephone) {
        document.getElementById('buttonFormulaire').disabled = false;
    } else {
        document.getElementById('buttonFormulaire').disabled = true;
    }
}

function attachEventListeners() {
    var codeINEField = document.getElementById('idEtudiantStage');
    var numMaitreStageField = document.getElementById('numMaitreStage');
    var idTuteurField = document.getElementById('idTuteur');
    var emailField = document.getElementById('email');
    var dateDebutField = document.getElementById('dateDebut');
    var dateFinField = document.getElementById('dateFin');
    var codeAPEField = document.getElementById('codeAPE');
    var numSiretField = document.getElementById('idEntreprise');
    var nomEntrepriseField = document.getElementById('nomEntreprise');
    var adresseEntrepriseField = document.getElementById('adresseEntreprise');
    var remunerationField = document.getElementById('remuneration');
    var telephoneEntrepriseField = document.getElementById('telephoneEntreprise');


    codeINEField.addEventListener('input', checkAll);
    numMaitreStageField.addEventListener('input', checkAll);
    idTuteurField.addEventListener('input', checkAll);
    emailField.addEventListener('input', checkAll);
    dateDebutField.addEventListener('input', checkAll);
    dateFinField.addEventListener('input', checkAll);

    codeAPEField.addEventListener('input', checkAll);
    numSiretField.addEventListener('input', checkAll);
    nomEntrepriseField.addEventListener('input', checkAll);
    adresseEntrepriseField.addEventListener('input', checkAll);
    remunerationField.addEventListener('input', checkAll);
    telephoneEntrepriseField.addEventListener('input', checkAll);

}

// Attacher les écouteurs d'événements une fois que le DOM est chargé
document.addEventListener('DOMContentLoaded', attachEventListeners);



