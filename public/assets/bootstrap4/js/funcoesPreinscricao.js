function converterDataFormatGringo(dt) {
  let data = dt.split("-");
  return data[1] + "/" + data[2] + "/" + data[0];
}

function preencherPrerenovacaoBolsa(data) {
  if (data) {
    $(".numeroInscricao").html(data.id);
    $(".responsavelAtu").html(data.nm_responsavel);
    $(".emailAtu").html(data.ds_email);
    $(".telefone1Atu").html(data.ds_telefone);
    $(".telefone2Atu").html(data.ds_celular);
    $("#emailBolsa").attr("value", data.ds_email);
    $("#emailVisita").attr("value", data.ds_email);
    $("#emailDocumento").attr("value", data.ds_email);
    $("#unidadeBolsa").attr(
      "value",
      data.unidade.nm_unidade + "-" + data.unidade_id
    );
    $("#unidadeVisita").attr(
      "value",
      data.unidade.nm_unidade + "-" + data.unidade_id
    );
    $("#unidadeDocumento").attr(
      "value",
      data.unidade.nm_unidade + "-" + data.unidade_id
    );

    let html =
      "<table class='table table-condensed' style='font-size:12px; width:100%'><thead><tr><th class='text-center font-weight-bold'>Matrícula</th><th class='font-weight-bold text-center'>Nome</th></tr></thead><tbody>";
    data.renovacaoaluno.map(function (element) {
      html +=
        "<tr style='font-size:12px'><td class='text-center'>" +
        element.nr_matricula +
        "</td><td class='text-center'>" +
        element.nm_aluno +
        "</td></tr>";
    });
    html += "</tbody></table>";

    $(".listaFilhosInscritos").html(html);
  }
}

function preencherPrematricula(
  data,
  seriesOfertadasParaBolsa,
  seriesOfertadasParaBolsa2Chamada
) {
  if (data) {
    $(".boxPrematricula").show();
    $("#idPrematricula").val(data.id);
    $("#responsavelAtu").html(data.nm_responsavel);
    $("#emailAtu").html(data.ds_email);
    $("#telefone1Atu").html(data.ds_celular);
    $("#telefone2Atu").html(data.ds_celular2);
    $("#comoConheceuAtu").html(data.ds_conheceu);
    $("#emailBolsa").attr("value", data.ds_email);
    $("#emailVisita").attr("value", data.ds_email);
    $("#emailDocumento").attr("value", data.ds_email);
    $("#unidadeBolsa").attr(
      "value",
      data.unidade.nm_unidade + "-" + data.unidade_id
    );
    $("#unidadeVisita").attr(
      "value",
      data.unidade.nm_unidade + "-" + data.unidade_id
    );
    $("#unidadeDocumento").attr(
      "value",
      data.unidade.nm_unidade + "-" + data.unidade_id
    );

    let html =
      "<table class='table table-condensed' style='font-size:12px; width:100%'><thead><tr><th class='text-center font-weight-bold'>Nome</th><th class='font-weight-bold text-center'>Série</th></tr></thead><tbody>";
    data.serie.map(function (element) {
      let ind = "";

      // if (seriesOfertadasParaBolsa.indexOf(element.pivot.serie_id) == -1)
      //   ind = "<br><span class='badge badge-dark'>bolsa social indisponível para esta série</span>";

      // if (seriesOfertadasParaBolsa2Chamada.indexOf(element.pivot.serie_id) != -1)
      //   ind = "<br><span class='badge badge-danger'>bolsa social disponível 2ª chamada</span>";

      html +=
        "<tr style='font-size:12px'><td class='text-center'>" +
        element.pivot.ds_nome_aluno +
        "</td><td class='text-center'>" +
        element.nm_serie +
        " - " +
        element.ds_turno +
        " " +
        ind +
        "</td></tr>";
    });

    html += "</tbody></table>";

    $("#listaFilhosInscritos").html(html);
  }
}

function buscarDatasDisponiveisAgendamentoDocumento(unidade) {
  $(".data_doc").html("");
  $.ajax({
    type: "POST",
    url: "./listar-datas-entrega-documento",
    data: { unidade: unidade },
    dataType: "json",
  })
    .done(function (res) {
      $(".data_doc").html('<option value=""></option>');
      res.map(function (elem) {
        $(".data_doc").append(
          "<option value='" +
          formatarDataParaWeb(elem) +
          "'>" +
          formatarDataParaWeb(elem) +
          "</option>"
        );
      });
    })
    .fail(function (res) {
      $(".data_doc").html("<option>erro</option>");
    });
}

function listarAgendamentoDoc(data_doc) {
  if (data_doc.length > 0) {
    data_doc.map(function (element) {
      $(".agendamentosRealizadosDocumento").append(
        "<tr><td class='text-center'>" +
        formatarDataParaWeb(element.data) +
        "</td><td class='text-center'>" +
        formatarHorarioParaWeb(element.horario) +
        "</td></tr>"
      );
    });
    $("#formAgendamentoDocumento2021").hide();
    $(".agendExcedido").html("(limite de agendamentos excedido)");
  } else
    $(".agendamentosRealizadosDocumento").append(
      "<tr><td colspan='2' class='text-center'>Nenhum registro encontrado.</td></tr>"
    );
}

/*
function preencherDatasEntregaDocumento(unidade)
{
    $(".data_doc").html('');
    $.ajax({
      type: "POST",
      url: "./listar-datas-documento",
      data: { unidade: unidade },
      dataType: "json"
    })
    .done(function(response){
      const datas = response;
      $(".data_doc").html('<option value=""></option>');
      datas.map(function(elem){
        $(".data_doc").append("<option value='"+formatarDataParaWeb(elem)+"'>"+formatarDataParaWeb(elem)+"</option>")
      })
    })
    .fail(function(response){
      $(".data_doc").html('<option>erro</option>');
    });
}
*/

function simEnao(sn) {
  return sn == 1 ? "Sim" : "Não";
}

function statusBolsaSocial(st) {
  st = st * 1;
  switch (st) {
    case 1:
      return "deferido";
      break;
    case 2:
      return "em atendimento";
      break;
    case 3:
      return "desclassificado";
      break;
    case 4:
      return "análise de recurso";
      break;
    case 0:
      return "não atendido";
      break;
    default:
      // return 'não atendido';
      break;
  }
}

function preencherMaisInfoUnidade(unidade) {
  $(".loaderComoChegar").show();
  $(".comoChegar").hide();
  $.ajax({
    url: "./info-unidade",
    type: "POST",
    dataType: "json",
    data: { unidade: unidade },
  })
    .done(function (data) {
      $(".loaderComoChegar").hide();
      $(".comoChegar").show();
      $(".telefoneUnidade").text(data.ds_telefone);
      $(".enderecoUnidade").text(data.ds_endereco_contrato);
      $(".nomeUnidade").text(data.nm_unidade);

      if (data.ds_edital_matricula != "") {
        $(".cardMatricula").show();
        $(".editalMatricula").attr(
          "href",
          "http://portal.salesianos.br/padm/storage/app/public/editais/" +
          data.ds_edital_matricula
        );
      } else $(".editalMatricula").attr("href", "javascript: alert('Edital temporariamente indisponível')");

      if (data.ds_edital != "")
        $(".editalBolsa").attr(
          "href",
          "http://portal.salesianos.br/padm/storage/app/public/editais/" +
          data.ds_edital
        );
      else
        $(".editalBolsa").attr(
          "href",
          "javascript: alert('Edital temporariamente indisponível')"
        );

      $(".editalBolsa2Chamada").hide();
      $(".relDocBolsa2Chamada").hide();
      if (data.ds_edital_2chamada_bolsa) {
        $(".editalBolsa2Chamada")
          .attr(
            "href",
            "http://portal.salesianos.br/padm/storage/app/public/editais/" +
            data.ds_edital_2chamada_bolsa
          )
          .show();
        $(".relDocBolsa2Chamada").show();

        switch (Number(unidade)) {
          case 1:
            $("#cronogramaBolsa2Chamada_ateneu").show();
            break;
          case 10:
            $("#cronogramaBolsa2Chamada_eamc").show();
            break;
          case 4:
            $("#cronogramaBolsa2Chamada_rm").show();
            break;
          case 11:
            $("#cronogramaBolsa2Chamada_sds").show();
            break;
          case 5:
            $("#cronogramaBolsa2Chamada_cdba").show();
            break;
          case 12:
            $("#cronogramaBolsa2Chamada_idb").show();
            break;
          case 8:
            $("#cronogramaBolsa2Chamada_ro").show();
            break;
          default:
            break;
        }
      }

      if (data.ds_imagem != "")
        $(".imagemUnidade").attr(
          "src",
          "./public/img/escolas/" + data.ds_imagem + ".jpg"
        );

      $(".siteUnidade").attr("href", data.ds_url);
    })
    .fail(function (data) {
      console.log("error", data);
    });
}

function toggleBox(obj) {
  $(obj).toggle("slow");
}

function formatarMoedaBolsaSocial(valor) {
  if (valor != "") {
    valor = valor + "";
    valor = parseInt(valor.replace(/[\D]+/g, ""));
    valor = valor + "";
    valor = valor.replace(/([0-9]{2})$/g, ",$1");

    if (valor.length > 6) {
      valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    }

    document.formBolsa2020.ds_renda_familiar.value = valor;
  }
}

function formatarDataParaWeb(data) {
  const dt = data.split("-");
  return dt[2] + "/" + dt[1] + "/" + dt[0];
}

function formatarDataHorarioParaWeb(data) {
  const dt_hr = data.split(" ");
  const dt = dt_hr[0].split("-");
  return dt[2] + "/" + dt[1] + "/" + dt[0] + " às " + dt_hr[1];
}

function retorarDataHoraAtual()
{
    const dNow = new Date();
    const localdate = dNow.getDate() + '/' + (dNow.getMonth()+1) + '/' + dNow.getFullYear() + ' às ' + dNow.getHours() + ':' + dNow.getMinutes() + ':' + dNow.getSeconds();
    return localdate;
}

function formatarHorarioParaWeb(horario) {
  const hr = horario.split(":");
  return hr[0] + ":" + hr[1];
}

function retirarPontoMoeda(num) {
  let newNum = num.replace(".", "");
  newNum = newNum.replace(".", "");
  newNum = newNum.replace(".", "");
  newNum = newNum.replace(".", "");
  newNum = newNum.replace(".", "");
  newNum = newNum.replace(",", ".");
  return parseFloat(newNum);
}

$(function () {
  $(".telefone").mask("(00) 0000-00009");
});
