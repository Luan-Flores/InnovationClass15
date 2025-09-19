// selecionando o modalCad e os botões de interação
const modalCad = document.querySelector(".modalCadBox");
const modalEdit = document.querySelector(".modalEditBox");
const modalDel = document.querySelector(".modalDelBox");
const btnClose = document.querySelector(".btn-close");
const btnDelClose = document.querySelector(".btn-del-close");
const btnDelCancel = document.querySelector(".btn-del-cancel");
const btnCancel = document.querySelector("#btn-cancelar");
const btnCadastrar = document.querySelector(".add-button");
const btnDeletar = document.querySelector(".btn-excluir");
const btnEdit = document.querySelector(".btn-editar");

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
btnEdit.addEventListener("click", () => {
	modalEdit.classList.remove("hidden");
});

//para o modal de deletar
btnDelClose.addEventListener("click", () => {
	modalDel.classList.add("hidden");
});
btnDelCancel.addEventListener("click", () => {
	modalDel.classList.add("hidden");
});

const allBtnEdit = document.querySelectorAll(".btn-editar");

allBtnEdit.forEach((btn) => {
	btn.addEventListener("click", () => {
		const id = btn.getAttribute("data-id");
		const nome = btn.getAttribute("data-nome");
		const quantidade = btn.getAttribute("data-quantidade");
		const sku = btn.getAttribute("data-sku");
		const preco = btn.getAttribute("data-preco");
		const categoria = btn.getAttribute("data-categoria");
		const fornecedor = btn.getAttribute("data-fornecedor");
		const descricao = btn.getAttribute("data-descricao");

		modalEdit.querySelector("#nomeProd").defaultValue = nome;
		modalEdit.querySelector("#skuProd").defaultValue = sku;
		modalEdit.querySelector("#precoProd").defaultValue = preco;
		modalEdit.querySelector("#categoriaProd").defaultValue = categoria;
		modalEdit.querySelector("#quantidadeProd").defaultValue = quantidade;
		modalEdit.querySelector("#fornecedorProd").defaultValue = fornecedor;
		modalEdit.querySelector("#inputDescEdit").defaultValue = descricao;
	});
});

const allBtnDelete = document.querySelectorAll(".btn-excluir");

//quando qualquer dos botoes de delete produto forem clicados,
//pegamos os atributos que eles contêm e alteramos o TEXTO dos campos para esses valores
allBtnDelete.forEach((btn) => {
	btn.addEventListener("click", () => {
		const id = btn.getAttribute("data-id");
		const nome = btn.getAttribute("data-nome");
		const quantidade = btn.getAttribute("data-quantidade");
		const sku = btn.getAttribute("data-sku");
		const preco = btn.getAttribute("data-preco");

		modalDel.querySelector("#nomeProd").textContent = nome;
		modalDel.querySelector("#qtdProd").textContent = quantidade;
		modalDel.querySelector("#skuProd").textContent = sku;
		modalDel.querySelector("#precoProd").textContent = preco;

		modalDel.dataset.id = id; // salva o id "escondido" para enviar ao backend

		//exibe o modal de remoção
		modalDel.classList.remove("hidden");
	});
});

const btnConfirmDelete = modalDel.querySelector(".btn-del-excluir");
btnConfirmDelete.addEventListener("click", () => {
	//pega o id do produto que salvamos antes
	const id = modalDel.dataset.id;

	if (id) {
		fetch(
			`../../app/controllers/ProdutoController.php?action=delete&id=${id}`,
			{
				method: "POST",
			}
		)
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					alert("Produto excluído com sucesso!");
					window.location.reload();
				} else {
					alert("Erro ao excluir produto");
				}
			})
			.catch((error) => {
				console.error("Erro na requisicao: ", error);
				alert("Erro de conexao com o servidor. ");
			});
	} else {
		alert("Nenhum produto selecionado para exclusão.");
	}
});
