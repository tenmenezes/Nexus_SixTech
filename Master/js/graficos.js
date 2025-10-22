// Seleciona o canvas
const ctx = document.getElementById("Sales").getContext("2d");

// Labels do gráfico
const labels = [
  "Jan",
  "Fev",
  "Mar",
  "Abr",
  "Mai",
  "Jun",
  "Jul",
  "Ago",
  "Set",
  "Out",
  "Nov",
  "Dez",
];

// Dados iniciais
const dadosProdutos = {
  todas: [120, 150, 180, 100, 170, 110, 140, 125, 20, 85, 10, 170],
  produtoA: [40, 50, 60, 20, 30, 50, 60, 40, 10, 20, 5, 40],
  produtoB: [30, 40, 70, 30, 60, 30, 40, 30, 5, 25, 3, 50],
  produtoC: [50, 60, 50, 50, 80, 30, 40, 55, 5, 40, 2, 80],
};

const metasProdutos = {
  todas: [130, 130, 160, 130, 160, 120, 100, 110, 20, 140, 150, 170],
  produtoA: [50, 55, 65, 40, 45, 55, 60, 50, 15, 25, 10, 45],
  produtoB: [35, 45, 60, 35, 55, 35, 40, 35, 10, 30, 5, 55],
  produtoC: [60, 65, 55, 60, 85, 40, 45, 60, 10, 45, 10, 85],
};

// Configuração inicial do gráfico
const data = {
  labels: labels,
  datasets: [
    {
      type: "bar",
      label: "Vendas",
      data: dadosProdutos.todas,
      backgroundColor: "rgba(54, 162, 235, 0.7)",
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 1,
    },
    {
      type: "line",
      label: "Meta",
      data: metasProdutos.todas,
      borderColor: "rgba(255, 99, 132, 1)",
      borderWidth: 2,
      fill: false,
      tension: 0.1,
      pointBackgroundColor: "white",
      pointBorderColor: "rgba(253, 0, 55, 1)",
    },
  ],
};

const options = {
  responsive: true,
  maintainAspectRatio: false,
  scales: {
    y: { beginAtZero: true, title: { display: true, text: "Quantidade" } },
    x: { title: { display: true, text: "Mês" } },
  },
  plugins: {
    title: { display: true, text: "Vendas vs Meta" },
    legend: { position: "top" },
    zoom: {
      zoom: { wheel: { enabled: true }, pinch: { enabled: true }, mode: "xy" },
      pan: { enabled: true, mode: "xy" },
    },
  },
};

// Instancia o gráfico
const graficoMisto = new Chart(ctx, {
  type: "bar",
  data: data,
  options: options,
});

// ---------- FILTRO DE PRODUTOS ----------
document
  .getElementById("produtoSelect")
  .addEventListener("change", function () {
    const produto = this.value;
    graficoMisto.data.datasets[0].data = dadosProdutos[produto];
    graficoMisto.data.datasets[1].data = metasProdutos[produto];
    graficoMisto.update();
  });

// ---------- BOTÕES DA TOOLBAR ----------

function gerarDatasetLinha(produto) {
  return [
    {
      type: "line",
      label: "Vendas",
      data: dadosProdutos[produto],
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 2,
      fill: false,
      tension: 0.1,
      pointBackgroundColor: "white",
      pointBorderColor: "rgba(253, 0, 55, 1)",
    },
  ];
}

function gerarDatasetBarra(produto) {
  return [
    {
      type: "bar",
      label: "Vendas",
      data: dadosProdutos[produto],
      backgroundColor: "rgba(54, 162, 235, 0.7)",
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 1,
    },
  ];
}

function gerarDatasetMisto(produto) {
  return [
    {
      type: "bar",
      label: "Vendas",
      data: dadosProdutos[produto],
      backgroundColor: "rgba(54, 162, 235, 0.7)",
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 1,
    },
    {
      type: "line",
      label: "Meta",
      data: metasProdutos[produto],
      borderColor: "rgba(255, 99, 132, 1)",
      borderWidth: 2,
      fill: false,
      tension: 0.1,
      pointBackgroundColor: "white",
      pointBorderColor: "rgba(253, 0, 55, 1)",
    },
  ];
}

let tipoGraficoAtual = "misto";

// Linha
document.getElementById("btn-linha").addEventListener("click", () => {
  graficoMisto.data.datasets = gerarDatasetLinha(produtoSelect.value);
  graficoMisto.update();
  tipoGraficoAtual = "linha";
});

// Barra
document.getElementById("btn-barra").addEventListener("click", () => {
  graficoMisto.data.datasets = gerarDatasetBarra(produtoSelect.value);
  graficoMisto.update();
  tipoGraficoAtual = "barra";
});

// Misto
document.getElementById("btn-misto").addEventListener("click", () => {
  graficoMisto.data.datasets = gerarDatasetMisto(produtoSelect.value);
  graficoMisto.update();
  tipoGraficoAtual = "misto";
});

// Exportar PNG
document.getElementById("btn-baixar-misto").addEventListener("click", () => {
  const link = document.createElement("a");
  link.href = graficoMisto.toBase64Image();

  if (tipoGraficoAtual === "linha") link.download = "grafico-linha.png";
  else if (tipoGraficoAtual === "barra") link.download = "grafico-barra.png";
  else link.download = "grafico-misto.png";

  link.click();
});

// Resetar zoom
document.getElementById("btn-resetar-misto").addEventListener("click", () => {
  graficoMisto.resetZoom();
});

/* ----------------- FIM GRÁFICO MISTO -------------------- */

const ctxLinha = document.getElementById("graficoLinha").getContext("2d");

const graficoLinha = new Chart(ctxLinha, {
  type: "line",
  data: {
    labels: [
      "Jan",
      "Fev",
      "Mar",
      "Abr",
      "Mai",
      "Jun",
      "Jul",
      "Ago",
      "Set",
      "Out",
      "Nov",
      "Dez",
    ],
    datasets: [
      {
        label: "Lucro Mensal (R$)",
        data: [
          5000, 7000, 6000, 8500, 7000, 10000, 12000, 11000, 9500, 13000, 12500,
          14000,
        ],
        borderColor: "rgba(75, 192, 192, 1)",
        backgroundColor: "rgba(75, 192, 192, 0.2)",
        fill: true,
        tension: 0.3, // suaviza a curva
        pointBackgroundColor: "white",
        pointBorderColor: "rgba(75, 192, 192, 1)",
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      title: {
        display: true,
        text: "Lucro Mensal - Gráfico de Linhas",
      },
      legend: {
        position: "top",
      },
    },
    plugins: {
      zoom: {
        zoom: {
          wheel: { enabled: true }, // zoom com scroll
          pinch: { enabled: true }, // zoom com gesto de pinça (touch)
          mode: "xy", // pode ser 'x', 'y' ou 'xy'
        },
        pan: {
          enabled: true,
          mode: "xy",
        },
      },
    },
    scales: {
      y: {
        beginAtZero: false,
        title: {
          display: true,
          text: "Valor (R$)",
        },
      },
    },
  },
});

const btnBaixar = document.querySelectorAll(".btn-baixar");
btnBaixar.forEach((btn) => {
  btn.addEventListener("click", () => {
    const link = document.createElement("a");
    link.href = graficoLinha.toBase64Image(); // ou outro gráfico específico
    link.download = "grafico-linha.png";
    link.click();
  });
});

const btnResetar = document.querySelectorAll(".btn-resetar");
btnResetar.forEach((btn) => {
  btn.addEventListener("click", () => {
    graficoLinha.resetZoom(); // ou outro gráfico específico
  });
});
/* ----------------- FIM GRÁFICO LINHAS -------------------- */

// Gráfico de Pizza
const ctxPizza = document.getElementById("pizzaChart").getContext("2d");
new Chart(ctxPizza, {
  type: "pie",
  data: {
    labels: [
      "Playstation games sold",
      "Xbox games sold",
      "Nintendo games sold",
    ],
    datasets: [
      {
        data: [870, 450, 680],
        backgroundColor: ["#2b2eebff", "#3cd317ff", "#cc2020ff"],
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: "bottom",
      },
    },
  },
});

/* ----------------- FIM GRÁFICO PIZZA -------------------- */

// Gráfico de Rosca
const ctxDoughnut = document.getElementById("doughnutChart").getContext("2d");
new Chart(ctxDoughnut, {
  type: "doughnut",
  data: {
    labels: [
      "PlayStation games in stock",
      "Xbox games in stock",
      "Nintendo games in stock",
    ],
    datasets: [
      {
        data: [1000, 1000, 1000],
        backgroundColor: ["#1916b3ff", "#2fc01cff", "#b11e1eff"],
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: "bottom",
      },
    },
  },
});

/* ----------------- FIM GRÁFICO ROSCA -------------------- */

const ctxRadar = document.getElementById("radarChart").getContext("2d");
new Chart(ctxRadar, {
  type: "radar",
  data: {
    labels: [
      "Ação",
      "Aventura",
      "RPG",
      "Esporte",
      "Estratégia",
      "Corrida",
      "Terror",
    ],
    datasets: [
      {
        label: "Vendas por Gênero",
        data: [120, 90, 150, 100, 80, 60, 50],
        backgroundColor: "rgba(245, 0, 53, 0.52)",
        borderColor: "rgba(150, 26, 52, 1)",
        pointBackgroundColor: "rgba(54, 0, 12, 1)",
      },
    ],
  },
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: "Distribuição de Vendas por Gênero",
        position: "bottom",
      },
      legend: { display: false }, // se quiser tirar a legenda também
    },
    scales: {
      r: {
        ticks: {
          display: false, // 🔥 remove os números
        },
        grid: {
          color: "rgba(184, 0, 0, 0.66)", // opcional: deixar a grade mais clean
        },
        angleLines: {
          color: "rgba(0, 0, 0, 0.2)", // opcional
        },
      },
    },
  },
});

/* ----------------- FIM GRÁFICO RADAR -------------------- */
