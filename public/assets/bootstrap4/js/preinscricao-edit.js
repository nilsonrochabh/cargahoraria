function preencherBolsa(data, data2) {
  if (Array.isArray(data)) {
    // $("#botaoResultadoBolsaSocial").show();
    $(".linkDocumentosRapido").show();
    // $("#boxResultadoBolsaSocial").show();

    $("#idBolsa").val(data[0].id);
    $(".agendamentosRealizadosDocumento").html("");
    listarAgendamentoDoc(data[0].agendamentodoc);
  } else {
    if (Array.isArray(data2)) {
      $("#boxOrientacoesBolsaSocial").show();
      // $("#boxResultadoBolsaSocial").show();
    } else {
      $("#boxOrientacoesBolsaSocial").hide();
      // $("#boxResultadoBolsaSocial").hide();
    }
  }
}

function preencherBolsaRenovacao(data) {
  if (data) {
    $("#idBolsa").val(data[0].id);
    listarAgendamentoDoc(data[0].agendamentodoc);
    $("#informacoesRenovacaoBolsa").show();
    $("#orientacoesRenovacaoBolsa").show();
    preencherPrerenovacaoBolsa(data[0]);
  }
}

function preencherVisita(data, bolsaRen) {
  if (Array.isArray(bolsaRen)) $(".boxAgendamentoVisitaConsulta").hide();
  else {
    $(".agendamentosRealizadosVisita").html("");
    if (Array.isArray(data))
      data.map(function (element) {
        const tipo = !element.ds_tipo ? "" : element.ds_tipo;
        $(".agendamentosRealizadosVisita").append(
          "<tr><td class='text-center'>" +
            formatarDataParaWeb(element.dt_visita) +
            "</td><td class='text-center'>" +
            formatarHorarioParaWeb(element.hr_visita) +
            "</td><td>" +
            tipo +
            "</td></tr>"
        );
      });
    else
      $(".agendamentosRealizadosVisita").append(
        "<tr><td colspan='2' class='text-center'>Nenhum registro encontrado</td></tr>"
      );

    $("#agendamentoRealizadosVisita").show();
  }
}

$(function () {
  const loaderEmail = $(".loaderEmail");
  const btSubmitEmail = $(".btConsultarEmail");
  const btSubmitBolsaAtu = $(".btSubmitBolsaAtu");
  const loaderBolsaAtu = $(".loaderBolsaAtu");
  $(".boxRendaAcima").hide();

  $(".btCadPreinscricaoEditar").click(function () {
    $(".boxOptions").slideUp("slow");
    $("#boxPreinscricaoConsulta").fadeIn("slow");
    $("#boxPreinscricao").hide();
  });

  $("#boxInscricaoBolsaSocial").hide();
  $("#boxResultadoBolsaSocial").hide();

  $("body").on("click", ".btInscreverBolsaSocial", function () {
    const aluno = $(this).attr("data-aluno");
    const serie = $(this).attr("data-serie");
    $(this).removeClass("btn-outline-danger");
    $(this).addClass("btn-outline-warning");
    $(this).removeClass("btInscreverBolsaSocial");
    $(this).text("aguarde");
    $.ajax({
      type: "POST",
      url: "./adicionar-aluno-bolsa-social",
      data: {
        idBolsa: $("#idBolsa").val(),
        aluno: aluno,
        serie: serie,
      },
      dataType: "json",
    })
      .done(function (resp) {
        $(this).removeClass("btInscreverBolsaSocial");
        $(this).removeClass("btn-outline-warning");
        $(this).addClass("btn-outline-success");
        $(this).text("Já inscrito para Bolsa Social");
      })
      .fail(function (error) {
        $(this).removeClass("btInscreverBolsaSocial");
        $(this).removeClass("btn-outline-warning");
        $(this).addClass("btn-outline-warning");
        $(this).text(
          "Ocorreu um erro interno, favor tentar novamente. Código do erro: MT03"
        );
      });
  });

  $("#btConsultaResultadoBolsa").click(function () {
    const ds_cpf = $("#cpfRes").val();
    const bolsa_id = $("#idBolsa").val();
    $("#retornoCpfConfirmarBolsa").html("");
    $("#tblListarAlunosBolsa").html("");

    if (
      validarCPF(ds_cpf, "#retornoCpfConfirmarBolsa", "#cpfRes") &&
      ds_cpf != ""
    ) {
      $("#loaderListarAlunosBolsa")
        .html('<img src="public/img/loader.gif" />')
        .show();
      $.ajax({
        type: "get",
        url: "./listar-alunos-bolsa-resultado",
        data: {
          ds_cpf: ds_cpf,
          bolsa_id: bolsa_id,
        },
        dataType: "json",
      })
        .done(function (response) {
            $("#loaderListarAlunosBolsa").hide();
            if (!response.erro) {
            // RESULTADO BOLSAS NOVAS
            const alunos = response.alunos[0]["serie"];
            alunos.map(function (element) {
                let html2 = "";
                html2 +=
                    "<tr><td><p><span class='badge badge-success'>novo pedido</span></p><p><strong>Aluno(a): </strong>" +
                    element["pivot"]["nm_aluno"] +
                    "</p><p><strong>Série: </strong>" +
                    element["nm_serie"] +
                    "</p></td><td><p><strong>Situação: </strong>" +
                    statusBolsaSocial(element["pivot"]["ie_status"]) +
                    "</p><p><strong>Documento entregue: </strong>" +
                    simEnao(element["pivot"]["ie_doc_entregue"]) +
                    "</p>";

                if (element["pivot"]["ds_obs"])
                    html2 +=
                    "<p style='white-space: pre-wrap'><strong>Mensagem: </strong>" +
                    element["pivot"]["ds_obs"] +
                    "</p>";

                html2 += "</td></tr>";

                $("#tblListarAlunosBolsa").append(html2);
            });
            // RESULTADO RENOVAÇÃO DE BOLSA
            const renovacao = response.alunos[0]["renovacaoaluno"];
            renovacao.map(function (element) {
              let html2 = "";
              html2 +=
                "<tr><td><p><span class='badge badge-secondary'>renovação de bolsa</span></p><p><strong>Matrícula: </strong>" +
                element["nr_matricula"] +
                "</p><p><strong>Aluno(a): </strong>" +
                element["nm_aluno"] +
                "</p></td><td><p><strong>Situação: </strong>" +
                statusBolsaSocial(element["ie_status"]) +
                "</p><p><strong>Documento entregue: </strong>" +
                simEnao(element["ie_doc_entregue"]) +
                "</p>";

            //   if (element["ds_obs"])
            //     html2 +=
            //       "<p><strong>Mensagem: </strong>" + element["ds_obs"] + "</p>";

              html2 += element.mensagens.map(item => item.mensagem).join('<br>');

              html2 += "</td></tr>";

              $("#tblListarAlunosBolsa").append(html2);
            });
          } else {
            $("#tblListarAlunosBolsa").html(
              '<tr><td colspan="2" class="text-center">Este CPF não foi localizado como senha deste cadastro.</td></tr>'
            );
          }
        })
        .fail(function () {
          $("#loaderListarAlunosBolsa")
            .html(
              "<p>Ocorreu um erro interno, favor tentar novamente. Código do erro: MT01</p>"
            )
            .show();
        });
    }
  });

  //Função que transforma a data Atual no padrão banco 
  function dataAtualFormatada(){
    var data = new Date(),
        dia  = data.getDate().toString(),
        diaF = (dia.length == 1) ? '0'+dia : dia,
        mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = (mes.length == 1) ? '0'+mes : mes,
        anoF = data.getFullYear();
    return anoF+"-"+mesF+"-"+diaF;
  }

  $("#btConsultaEmail").click(function () {
    $(this).prop("disabled", true);
    loaderEmail.show();

    $("#erroFormConsultaEmail").html("");

    $.ajax({
      type: "POST",
      url: "./pesquisar-prematricula-por-email",
      data: { email: $("#emailConsulta").val() },
      dataType: "json",
    })
      .done(function (data) {
        console.log("aqui estou",data);
        
        if(data.bolsaRenovacaoInfo!=""){
          //mostrar pega a data final da unidade 
        var dataFinal = data.bolsaRenovacaoInfo[0].unidade.dt_final_bolsa;
        
         console.log(dataFinal);
         var dataAtual = Date('now');
          dataAtual = dataAtualFormatada(dataAtual);
          if(dataFinal < dataAtual){
            $('.custom-select').prop("disabled", true);
            $('#inputGroupFile1').prop("disabled", true);
            $('#inputGroupFile2').prop("disabled", true);
            $('#inputGroupFile3').prop("disabled", true);
            $('#inputGroupFile4').prop("disabled", true);
            $('#button1').prop("disabled",true);
            $('.btListAttachments').remove();
            $('#MensagemData').html(`<p class="alert alert-danger" style="vertical-align:middle" role="alert"> Expirou o prazo de envio de documentos</p>`);
           }
          }    
        
        
            if (!data.prematriculaInfo && !data.bolsaRenovacaoInfo)
              $("#erroFormConsultaEmail").html("Nenhum registro encontrado");
            else {
              /* SHOW DIVS */
              $("#boxPesquisaEmail").slideUp("slow");
              $(".boxAgendamentoVisitaConsulta").show();
              $("#formConsultaEmail").slideUp("slow");
              $("#boxVisitaAtu").show();
              $("#boxMaisPreinscricaoConsulta").show();
              $("#informacoesPreinscricao").show();
              // ----------------

              if (!data.prematriculaInfo) $("#informacoesPreinscricao").hide();

              $("#unidade_id").val("t-" + data.unidade);

              $(".informativoBolsaSocial").hide();
              // if (data.isOfertaBolsa == true || data.isOfertaBolsa2Chamada == true)
              if (data.isOfertaBolsa2Chamada) $(".informativoBolsaSocial").show();

              $("#boxResultadoBolsaSocial").hide();

              if (data.bolsaInfo || data.bolsaRenovacaoInfo) {
                const dt_inicial = data.bolsaInfo
                  ? data.bolsaInfo[0].unidade.dt_inicial_bolsa
                  : data.bolsaRenovacaoInfo[0].unidade.dt_inicial_bolsa;
                const dt_final = data.bolsaInfo
                  ? data.bolsaInfo[0].unidade.dt_final_bolsa
                  : data.bolsaRenovacaoInfo[0].unidade.dt_final_bolsa;

                if (dt_inicial && dt_final) {
                  const dataHoje = new Date();
                  const dataInicial = new Date(
                    converterDataFormatGringo(dt_inicial) + " 00:00"
                  );
                  const dataFinal = new Date(
                    converterDataFormatGringo(dt_final) + " 00:00"
                  );
                  if (dataHoje >= dataInicial && dataHoje <= dataFinal) {
                    console.log(dt_inicial, dt_final);
                    $("#boxResultadoBolsaSocial").show();
                  }
                }
              }
      
          preencherMaisInfoUnidade(data.unidade);
          preencherPrematricula(
            data.prematriculaInfo[0],
            data.seriesOfertadasParaBolsa,
            data.seriesOfertadasParaBolsa2Chamada
          );
          preencherBolsa(data.bolsaInfo, data.bolsaRenovacaoInfo);
          preencherBolsaRenovacao(data.bolsaRenovacaoInfo);
          buscarDatasDisponiveisAgendamentoDocumento(data.unidade);
          preencherVisita(data.visitaInfo, data.bolsaRenovacaoInfo);
        }
      })
      .fail(function (data) {
        $("#erroFormConsultaEmail").html(
          "Ocorreu um erro interno, favor tentar novamente. Código do erro: MT02"
        );
      })
      .always(function () {
        btSubmitEmail.prop("disabled", false);
        loaderEmail.hide();
      });
  });

  $(".btVerificarRendaMinima").click(function () {
    const nr_pessoas_familia = $("#nr_pessoas_familia").val();
    const ds_renda_familiar = retirarPontoMoeda($("#ds_renda_familiar").val());
    $(".boxRendaAcima").hide();
    if (nr_pessoas_familia && ds_renda_familiar) {
      resultado = ds_renda_familiar / nr_pessoas_familia;
      if (resultado <= 2994) {
        $(".maisInfoCPFBolsa").show();
        $("#ds_cpf").prop("required", true);
        ds_cpf = $("#ds_cpf").val();
        $(".btVerificarRendaMinima").html(
          "Confirmar inscrição para o processo de Bolsa Social"
        );
        if (validarCPF(ds_cpf, "#retornoCpf", "#ds_cpf") && ds_cpf != "")
          $("#formBolsa2020").trigger("submit");
      } else {
        $(".boxRendaAcima").show();
        loaderBolsaAtu.hide();
        btSubmitBolsaAtu.prop("disabled", false);
      }
    }
  });

  $("#formBolsa2020").on("submit", function (e) {
    $(".boxRendaAcima").hide();
    e.preventDefault();

    btSubmitBolsaAtu.prop("disabled", true);
    loaderBolsaAtu.show();
    const dadosBolsa = $(this).serialize();
    $.ajax({
      url: "./cadastrar-bolsa",
      type: "POST",
      dataType: "json",
      data: dadosBolsa + "&id_prematricula=" + $("#idPrematricula").val(),
    })
      .done(function (data) {
        if (!data.erro) {
          loaderBolsaAtu.hide();
          $(".opsBolsa")
            .html(
              '<small class="text-success">Cadastrado com sucesso. Aguarde...</small>'
            )
            .show();
          setTimeout(function () {
            $("#boxInscricaoBolsaSocial").slideUp("slow");
            $("#boxOrientacoesBolsaSocial").fadeIn();
            $("#boxResultadoBolsaSocial").show();
            $(".informativoBolsaSocial").hide();
          }, 2000);
          $("#idBolsa").val(data.bolsa["id_bolsa"]);
          btSubmitBolsaAtu.prop("disabled", false);
        } else if (data.erro) {
          $(".opsBolsa")
            .html('<small class="text-danger">' + data.mensagem + "</small>")
            .show();
          loaderBolsaAtu.hide();
          btSubmitBolsaAtu.prop("disabled", false);
        }
      })
      .fail(function (data) {
        $(".opsBolsa").show();
        loaderBolsaAtu.hide();
        btSubmitBolsaAtu.prop("disabled", false);
      });
  });
});
