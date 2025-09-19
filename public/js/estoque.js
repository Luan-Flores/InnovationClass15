// selecionando o modalCad e os botões de interação
const modalCad = document.querySelector(".modalCadBox");
const modalDel = document.querySelector(".modalDelBox");
const btnClose = document.querySelector(".btn-close");
const btnDelClose = document.querySelector(".btn-del-close");
const btnDelCancel = document.querySelector(".btn-del-cancel");
const btnCancel = document.querySelector("#btn-cancelar");
const btnCadastrar = document.querySelector(".add-button");
const btnDeletar = document.querySelector(".btn-excluir");

btnClose.addEventListener("click", () => {
	// adicionando a classe 'hidden' ao modalCad (para esconder ao clicar no fechar ou cancelar)
	modalCad.classList.add("hidden");
});
btnCancel.addEventListener("click", () => {
	modalCad.classList.add("hidden");
});

//aqui remove a classe hidden (ao clicar no botao "adicionar produto")
btnCadastrar.addEventListener("click", () => {
	modalCad.classList.remove("hidden");
});
btnDeletar.addEventListener("click", () => {
	modalDel.classList.remove("hidden");
});

//para o modal de deletar
btnDelClose.addEventListener("click", () => {
	modalDel.classList.add("hidden");
});
btnDelCancel.addEventListener("click", () => {
	modalDel.classList.add("hidden");
});
