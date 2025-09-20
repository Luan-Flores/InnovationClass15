// selecionando o modalCad e os botões de interação
const modalCad = document.querySelector(".modalCadBox");
const modalEdit = document.querySelector(".modalEditBox");
const modalDel = document.querySelector(".modalDelBox");
const btnClose = document.querySelector(".btn-close");
const btnDelClose = document.querySelector(".btn-del-close");
const btnDelCancel = document.querySelector(".btn-del-cancel");
const btnCancel = document.querySelector("#btn-cancelar");
const btnEditCancelar = document.querySelector("#btn-edit-cancelar");
const btnCadastrar = document.querySelector(".add-button");
const btnDeletar = document.querySelector(".btn-excluir");
const btnEdit = document.querySelector(".btn-editar");
const btnEditClose = document.querySelector("#btn-edit-close");

btnClose.addEventListener("click", () => {
	// adicionando a classe 'hidden' ao modalCad (para esconder ao clicar no fechar ou cancelar)
	modalCad.classList.add("hidden");
});
btnCancel.addEventListener("click", () => {
	modalCad.classList.add("hidden");
});
btnEditCancelar.addEventListener("click", () => {
	modalEdit.classList.add("hidden");
});

//aqui remove a classe hidden (ao clicar no botao "adicionar produto")
btnCadastrar.addEventListener("click", () => {
	modalCad.classList.remove("hidden");
});
btnEdit.addEventListener("click", () => {
	modalEdit.classList.remove("hidden");
});

//para fechar os modais (botão em X)
btnDelClose.addEventListener("click", () => {
	modalDel.classList.add("hidden");
});
btnEditClose.addEventListener("click", () => {
	modalEdit.classList.add("hidden");
});
btnDelCancel.addEventListener("click", () => {
	modalDel.classList.add("hidden");
});

const allBtnEdit = document.querySelectorAll(".btn-editar");

allBtnEdit.forEach((btn) => {
	btn.addEventListener("click", () => {
		console.log("CLICOU");
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

		modalEdit.dataset.id = id;

		modalEdit.classList.remove("hidden");
	});
});

//botao de limpar os campos do modal de edit
const allBtnLimparEdit = document.querySelectorAll(".btn-limpar-edit");

allBtnLimparEdit.forEach((btn) => {
	btn.addEventListener("click", () => {
		modalEdit.querySelector("#nomeProd").defaultValue = "";
		modalEdit.querySelector("#skuProd").defaultValue = "";
		modalEdit.querySelector("#precoProd").defaultValue = "";
		modalEdit.querySelector("#categoriaProd").defaultValue = "";
		modalEdit.querySelector("#quantidadeProd").defaultValue = "";
		modalEdit.querySelector("#fornecedorProd").defaultValue = "";
		modalEdit.querySelector("#inputDescEdit").defaultValue = "";
	});
});

const btnSalvarEdit = modalEdit.querySelector(".btn-salvar-edit");
btnSalvarEdit.addEventListener("click", () => {
	const id = modalEdit.dataset.id;

	// Pegar os valores dos inputs
	const nome = modalEdit.querySelector("#nomeProd").value.trim();
	const sku = modalEdit.querySelector("#skuProd").value.trim();
	const preco = modalEdit.querySelector("#precoProd").value.trim();
	const categoria = modalEdit.querySelector("#categoriaProd").value.trim();
	const quantidade = modalEdit.querySelector("#quantidadeProd").value.trim();
	const fornecedor = modalEdit.querySelector("#fornecedorProd").value.trim();
	const descricao = modalEdit.querySelector("#inputDescEdit").value.trim();

	// validação para nao enviar o edit com todos os campos vazios
	if (!nome || !sku || !preco || !categoria || !quantidade || !fornecedor) {
		alert("Todos os campos devem ser preenchidos antes de salvar.");
		return; // bloqueia o fetch se tiver vazio
	}

	const produto = {
		nome,
		sku,
		preco,
		categoria,
		quantidade,
		fornecedor,
		descricao,
	};
	// fetch na produtocontroller com a acao de editar passando o id e os valores dos inputs do produto editado
	if (id) {
		fetch(`../../app/controllers/ProdutoController.php?action=edit&id=${id}`, {
			method: "PUT",
			headers: {
				"Content-Type": "application/json",
			},
			body: JSON.stringify(produto),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.success) {
					alert("Produto editado com sucesso!");
					window.location.reload();
				} else {
					alert("Erro ao editar produto");
				}
			})
			.catch((error) => {
				console.error("Erro na requisicao: ", error);
				alert("Erro de conexao com o servidor.");
			});
	} else {
		alert("Nenhum produto selecionado para edição.");
	}
});

const allBtnDelete = document.querySelectorAll(".btn-excluir");

//quando qualquer dos botoes de delete produto forem clicados,
//pegamos os atributos que ele contêm e alteramos o TEXTO dos campos para esses valores
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

//botao de limpar os campos do modal de cadastro
const allBtnLimparCad = document.querySelectorAll(".btn-limpar-cad");

allBtnLimparCad.forEach((btn) => {
	btn.addEventListener("click", () => {
		const inputCad = modalCad.querySelectorAll("input");
		inputCad.forEach((inp) => {
			inp.value = "";
			modalCad.querySelector(".inputDesc").value = ""; //campo da descrição é diferente pois nao é input, e sim um textarea
		});
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

//barra de pesquisa

const searchBar = document.getElementById("searchBar");
const tr = document.getElementsByTagName("tr");
const colNome = document.getElementById("th-nome");

searchBar.addEventListener("input", () => {
	const pesquisa = searchBar.value.toLowerCase();
	for (elem of tr) {
		const campoTitulo = elem.firstElementChild;
		if (!campoTitulo) continue; //para ignorar as linhas sem o td

		if (campoTitulo === colNome) continue; // ignorar a coluna NOME para nao ser destacada como os produtos

		const nomeProd = campoTitulo.textContent;

		if (pesquisa && nomeProd.toLowerCase().includes(pesquisa)) {
			// expressão regular que pega o termo pesquisado
			const regex = new RegExp(`(${pesquisa})`, "gi");

			// envolve o trecho em <span> para destacar o fundo e a fonte
			campoTitulo.innerHTML = nomeProd.replace(
				regex,
				`<span style="background-color: yellow; font-weight: bold;">$1</span>`
			);
		} else {
			// volta ao normal se não tiver pesquisa
			campoTitulo.innerHTML = nomeProd;
		}
	}
});
