let CNPJ = require("cnpj-receita-federal");
var express = require("express");
const http = require("http");
const { Router } = require("express");

const routes = Router();

let cnpj = new CNPJ();
const app = express();
const server = http.Server(app);
app.use(express.json());
app.use(routes);


routes.post("/receita", (request, response) => {
  const [cnpj_value] = request.body;

  cnpj
    .consultaCNPJ({ cnpj: cnpj_value })
    .then((result) => {
      return response.json({ result });
    })
    .catch((error) => {
      console.error(error);
    });
});

server.listen(3333);
