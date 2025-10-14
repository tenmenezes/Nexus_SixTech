// Arrays de dados base para gerar registros aleatórios
const nomesClientes = [
  "Mano Silva",
  "Ana Costa",
  "Carlos Lima",
  "Beatriz Souza",
  "Lucas Mendes",
];
const emails = [
  "mano@email.com",
  "ana@email.com",
  "carlos@email.com",
  "beatriz@email.com",
  "lucas@email.com",
];
const jogos = [
  "Cyber Adventure",
  "Space Shooter",
  "Fantasy Quest",
  "Racing Pro",
  "Horror Night",
];
const plataformas = ["PC", "PS5", "Xbox", "Nintendo Switch", "Mobile"];
const generos = ["RPG", "Ação", "Aventura", "Esporte", "Corrida", "Terror"];
const statusPossiveis = ["Concluído", "Pendente", "Cancelado"];

// Função para gerar um número aleatório dentro de um intervalo
function randomInt(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Função para gerar data aleatória nos últimos 30 dias
function randomDate() {
  const start = new Date();
  start.setDate(start.getDate() - 30);
  const end = new Date();
  const date = new Date(
    start.getTime() + Math.random() * (end.getTime() - start.getTime())
  );
  return date.toISOString().split("T")[0]; // Retorna "YYYY-MM-DD"
}

// Função para gerar hora aleatória
function randomTime() {
  const hour = String(randomInt(0, 23)).padStart(2, "0");
  const minute = String(randomInt(0, 59)).padStart(2, "0");
  const second = String(randomInt(0, 59)).padStart(2, "0");
  return `${hour}:${minute}:${second}`;
}

// Gerar 50 registros
const vendasData = Array.from({ length: 50 }, (_, i) => {
  const clienteIndex = randomInt(0, nomesClientes.length - 1);
  const jogoIndex = randomInt(0, jogos.length - 1);
  const plataformaIndex = randomInt(0, plataformas.length - 1);
  const generoIndex = randomInt(0, generos.length - 1);
  const quantidade = randomInt(1, 5);
  const preco_unitario = randomInt(50, 300); // preço entre 50 e 300
  const valor_total = quantidade * preco_unitario;

  const data_pedido = randomDate();
  const criado_em = `${data_pedido} ${randomTime()}`;

  return {
    id_pedido: 100 + i + 1,
    data_pedido,
    cliente: nomesClientes[clienteIndex],
    email: emails[clienteIndex],
    jogo: jogos[jogoIndex],
    plataforma: plataformas[plataformaIndex],
    genero: generos[generoIndex],
    quantidade,
    preco_unitario,
    subtotal: quantidade * preco_unitario,
    valor_total,
    status: statusPossiveis[randomInt(0, statusPossiveis.length - 1)],
    criado_em,
  };
});

// Inicializa a tabela Tabulator com os 50 registros
const table = new Tabulator("#sales-table", {
  data: vendasData,
  layout: "fitColumns",
  responsiveLayout: "hide",
  columns: [
    { title: "ID do Pedido", field: "id_pedido", sorter: "number", width: 120 },
    { title: "Data do Pedido", field: "data_pedido", sorter: "date" },
    { title: "Cliente", field: "cliente", sorter: "string" },
    { title: "E-mail do Cliente", field: "email", sorter: "string" },
    { title: "Jogo", field: "jogo", sorter: "string" },
    { title: "Plataforma", field: "plataforma", sorter: "string" },
    { title: "Gênero", field: "genero", sorter: "string" },
    {
      title: "Quantidade",
      field: "quantidade",
      sorter: "number",
      hozAlign: "right",
    },
    {
      title: "Preço Unitário",
      field: "preco_unitario",
      sorter: "number",
      formatter: "money",
      formatterParams: { symbol: "R$", precision: 2 },
      hozAlign: "right",
    },
    {
      title: "Subtotal",
      field: "subtotal",
      sorter: "number",
      formatter: "money",
      formatterParams: { symbol: "R$", precision: 2 },
      hozAlign: "right",
    },
    {
      title: "Valor Total do Pedido",
      field: "valor_total",
      sorter: "number",
      formatter: "money",
      formatterParams: { symbol: "R$", precision: 2 },
      hozAlign: "right",
    },
    { title: "Status do Pedido", field: "status", sorter: "string" },
    { title: "Criado em", field: "criado_em", sorter: "datetime" },
  ],
  pagination: "local",
  paginationSize: 20,
  movableColumns: true,
});

/* Filtro de vendas */

const searchSales = document.getElementById("searchSales");

searchSales.addEventListener("input", function () {
  const termo = searchSales.value.toLowerCase();

  if (termo === "") {
    table.clearFilter();
  } else {
    table.setFilter(function (data) {
      return Object.values(data).some((value) =>
        String(value).toLowerCase().includes(termo)
      );
    });
  }
});
