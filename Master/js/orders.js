// Arrays de dados base para gerar registros aleatórios
const clientes = [
  "Mano Silva",
  "Ana Costa",
  "Carlos Lima",
  "Beatriz Souza",
  "Lucas Mendes",
];
const statusPossiveis = ["finalizado", "cancelado", "pendente"];
const formasPagamento = ["PIX", "Cartão", "Boleto"];

// Função para gerar número aleatório
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
  return date.toISOString().split("T")[0]; // YYYY-MM-DD
}

// Função para gerar hora aleatória
function randomTime() {
  const hour = String(randomInt(0, 23)).padStart(2, "0");
  const minute = String(randomInt(0, 59)).padStart(2, "0");
  const second = String(randomInt(0, 59)).padStart(2, "0");
  return `${hour}:${minute}:${second}`;
}

// Gerar 50 registros de pedidos
const pedidosData = Array.from({ length: 50 }, (_, i) => {
  const clienteIndex = randomInt(0, clientes.length - 1);
  const quantidade_itens = randomInt(1, 5);
  const valor_total = quantidade_itens * randomInt(50, 300);
  const data_pedido = randomDate();
  const ultima_atualizacao = `${data_pedido} ${randomTime()}`;

  return {
    id_pedido: 200 + i + 1,
    data_pedido,
    cliente: clientes[clienteIndex],
    status: statusPossiveis[randomInt(0, statusPossiveis.length - 1)],
    quantidade_itens,
    valor_total,
    pagamento: formasPagamento[randomInt(0, formasPagamento.length - 1)],
    ultima_atualizacao,
  };
});

// Inicializa a tabela Tabulator
const tablePedidos = new Tabulator("#orders-table", {
  data: pedidosData,
  layout: "fitColumns",
  responsiveLayout: "hide",
  columns: [
    { title: "ID do Pedido", field: "id_pedido", sorter: "number", width: 120 },
    { title: "Data do Pedido", field: "data_pedido", sorter: "string" }, // trocado para string
    { title: "Cliente", field: "cliente", sorter: "string" },
    { title: "Status", field: "status", sorter: "string" },
    {
      title: "Quantidade de Itens",
      field: "quantidade_itens",
      sorter: "number",
      hozAlign: "right",
    },
    {
      title: "Valor Total",
      field: "valor_total",
      sorter: "number",
      formatter: "money",
      formatterParams: { symbol: "R$", precision: 2 },
      hozAlign: "right",
    },
    { title: "Forma de Pagamento", field: "pagamento", sorter: "string" },
    {
      title: "Última Atualização",
      field: "ultima_atualizacao",
      sorter: "string", // trocado para string para não depender do Luxon
    },
  ],
  pagination: "local",
  paginationSize: 20,
  movableColumns: true,
  initialSort: [{ column: "data_pedido", dir: "desc" }],
});

/* Filtro de pedidos */

const searchOrders = document.getElementById("searchOrders");

searchOrders.addEventListener("input", function () {
  const termo = searchOrders.value.toLowerCase();

  if (termo === "") {
    tablePedidos.clearFilter();
  } else {
    tablePedidos.setFilter(function (data) {
      return Object.values(data).some((value) =>
        String(value).toLowerCase().includes(termo)
      );
    });
  }
});
