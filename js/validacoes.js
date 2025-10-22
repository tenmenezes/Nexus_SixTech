const form = document.querySelector("#form");

function validaCNPJ(cnpj) {
  var b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
  var c = String(cnpj).replace(/[^\d]/g, "");

  if (c.length !== 14) {
    alert("cnpj inválido!");
    document.getElementById("cnpj").value = "";
    return false;
  }

  if (/0{14}/.test(c)) {
    alert("cnpj inválido!");
    document.getElementById("cnpj").value = "";
    return false;
  }
  for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]);
  if (c[12] != ((n %= 11) < 2 ? 0 : 11 - n)) {
    alert("cnpj inválido!");
    document.getElementById("cnpj").value = "";
    return false;
  }
  for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]);
  if (c[13] != ((n %= 11) < 2 ? 0 : 11 - n)) {
    alert("cnpj inválido!");
    document.getElementById("cnpj").value = "";
    return false;
  }
  return true;
}
form.addEventListener("submit", function (e) {
  e.preventDefault();

  const campos = [
    {
      id: "nome",
      label: "nome",
      validator: nameIsValid,
    },
    {
      id: "data-nascimento",
      label: "dataFundacao",
      validator: dateIsValid,
    },
    {
      id: "cnpj",
      label: "cnpj",
      validator: cnpjIsValid,
    },
    {
      id: "responsavel",
      label: "responsavel",
      validator: nameIsValid,
    },
    {
      id: "cep",
      label: "cep",
      validator: cepIsValid,
    },
    {
      id: "endereco",
      label: "endereco",
      validator: nameIsValid,
    },
    {
      id: "estado",
      label: "estado",
      validator: estadoIsValid,
    },
    {
      id: "cidade",
      label: "cidade",
      validator: nameIsValid,
    },
    {
      id: "numero",
      label: "numero",
      validator: cnpjIsValid,
    },
    {
      id: "email",
      label: "email",
      validator: emailIsValid,
    },
    {
      id: "senha",
      label: "senha",
      validator: senhaIsValid,
    },
    {
      id: "confirmacao-senha",
      label: "confirmacao-senha",
      validator: ConfirmsenhaIsValid,
    },
  ];
  const erroIcon = '<i class="fa-solid fa-circle-exclamation"></i>';

  campos.forEach(function (field) {
    const input = document.getElementById(field.id);
    const inputBox = input.closest(".input-box");
    const iputValue = input.value;
    const errorSpan = inputBox.querySelector(".error");

    errorSpan.innerHTML = "";

    inputBox.classList.remove("invalid");
    inputBox.classList.add("valid");

    const fieldValidator = field.validator(iputValue);

    if (!fieldValidator.isValid) {
      errorSpan.innerHTML = `${erroIcon} ${fieldValidator.errorMessage}`;
      inputBox.classList.add("invalid");
      inputBox.classList.remove("valid");
      return;
    }
  });
});

function isEmpty(value) {
  return value === "";
}

function nameIsValid(value) {
  const validator = {
    isValid: true,
    errorMessage: null,
  };

  if (isEmpty(value)) {
    validator.isValid = false;
    validator.errorMessage = "O campo é obrigatório.";
    return validator;
  }
  const min = 3;

  if (value.length < min) {
    validator.isValid = false;
    validator.errorMessage = `O campo deve conter no mínimo ${min} caracteres.`;
    return validator;
  }

  const regex = /^([a-zA-Zà-úÀ-Ú]|\s+)+$/;
  if (!regex.test(value)) {
    validator.isValid = false;
    validator.errorMessage = "Favor digitar apenas letras.";
    return validator;
  }

  return validator;
}

function estadoIsValid(value) {
  const validator = {
    isValid: true,
    errorMessage: null,
  };

  if (isEmpty(value)) {
    validator.isValid = false;
    validator.errorMessage = "O campo é obrigatório.";
    return validator;
  }
  const min = 2;

  if (value.length < min) {
    validator.isValid = false;
    validator.errorMessage = `O campo deve conter ${min} caracteres.`;
    return validator;
  }

  const regex = /^([a-zA-Zà-úÀ-Ú]|\s+)+$/;
  if (!regex.test(value)) {
    validator.isValid = false;
    validator.errorMessage = "Favor digitar apenas letras.";
    return validator;
  }

  return validator;
}

function dateIsValid(value) {
  const validator = {
    isValid: true,
    errorMessage: null,
  };
  if (isEmpty(value)) {
    validator.isValid = false;
    validator.errorMessage = "O campo é obrigatório.";
    return validator;
  }
  const year = new Date(value).getFullYear();
  const day = new Date();
  const data = new Date(value);

  //se o ano for menos que 1920 ou o ano maior que o atual ou data de fundação for maior que o dia atual
  if (year < 1920 || year > new Date().getFullYear() || day < data) {
    validator.isValid = false;
    validator.errorMessage = "Data inválida.";
    return validator;
  }
  return validator;
}

function cnpjIsValid(value) {
  const validator = {
    isValid: true,
    errorMessage: null,
  };
  if (isEmpty(value)) {
    validator.isValid = false;
    validator.errorMessage = "O campo é obrigatório.";
    return validator;
  }

  const regex =
    /^(?:-(?:[1-9](?:\d{0,2}(?:,\d{3})+|\d*))|(?:0|(?:[1-9](?:\d{0,2}(?:,\d{3})+|\d*))))(?:.\d+|)$/; /*/[-]{0,1}[\d]*[,]?[\d]*[.]{0,1}[\d]+/g*/
  if (!regex.test(value)) {
    validator.isValid = false;
    validator.errorMessage = "Favor digitar apenas numeros.";
    return validator;
  }

  return validator;
}

function cepIsValid(value) {
  const validator = {
    isValid: true,
    errorMessage: null,
  };
  if (isEmpty(value)) {
    validator.isValid = false;
    validator.errorMessage = "O campo é obrigatório.";
    return validator;
  }

  const regex =
    /^(?:-(?:[1-9](?:\d{0,2}(?:,\d{3})+|\d*))|(?:0|(?:[1-9](?:\d{0,2}(?:,\d{3})+|\d*))))(?:.\d+|)$/; /*/[-]{0,1}[\d]*[,]?[\d]*[.]{0,1}[\d]+/g*/
  if (!regex.test(value)) {
    validator.isValid = false;
    validator.errorMessage = "Favor digitar apenas numeros.";
    return validator;
  }

  return validator;
}

function emailIsValid(value) {
  const validator = {
    isValid: true,
    errorMessage: null,
  };
  if (isEmpty(value)) {
    validator.isValid = false;
    validator.errorMessage = "O campo é obrigatório.";
    return validator;
  }

  const regex = new RegExp("^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$");

  if (!regex.test(value)) {
    validator.isValid = false;
    validator.errorMessage = "Informe um email válido.";
    return validator;
  }
  return validator;
}

function senhaIsValid(value) {
  const validator = {
    isValid: true,
    errorMessage: null,
  };

  if (isEmpty(value)) {
    validator.isValid = false;
    validator.errorMessage = "O campo é obrigatória!";
    return validator;
  }

  const regex = new RegExp(
    "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{8,})"
  );

  if (!regex.test(value)) {
    validator.isValid = false;
    validator.errorMessage = `
            Sua senha deve conter ao menos: <br/>
            8 dígitos <br/>
            1 letra minúscula <br/>
            1 letra maiúscula  <br/>
            1 número </br>
            1 caractere especial!
        `;
    return validator;
  }

  return validator;
}

function ConfirmsenhaIsValid(value) {
  const validator = {
    isValid: true,
    errorMessage: null,
  };

  const passwordValue = document.getElementById("senha").value;

  if (value === "" || passwordValue !== value) {
    validator.isValid = false;
    validator.errorMessage = "Senhas não condizem!";
    return validator;
  }
  window.location.href = "index.html";
  return validator;
}
