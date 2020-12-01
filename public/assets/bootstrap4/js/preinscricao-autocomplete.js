$(function () {
  $(".data_doc").change(function () {
    const und = $("#unidade_id").val().split("-");
    const unidade = und[1];
    const data = $(this).val();
    $(".horario_doc").html("<option>aguarde...</option>");
    $.ajax({
      type: "post",
      url: "./listar-horarios-documento",
      data: {
        unidade: unidade,
        data: data,
      },
      dataType: "json",
    })
      .done(function (response) {
        const horarios = response;
        if (horarios.length > 0) {
          $(".horario_doc").html("<option></option>");
          horarios.map(function (element) {
            $(".horario_doc").append(
              "<option value='" +
                formatarHorarioParaWeb(element) +
                "'>" +
                formatarHorarioParaWeb(element) +
                "</option>"
            );
          });
          $(".btAgendamentoDoc").prop("disabled", false);
        } else {
          $(".horario_doc").html("<option>Nenhum horário disponível</option>");
          $(".btAgendamentoDoc").prop("disabled", true);
        }
      })
      .fail(function (response) {
        $(".horario_doc").html("<option></option>");
      });
  });

  $(".dataVisita").change(function () {
    var data = $(this).val();
    var unidade = $("#unidade_id").val();
    var horario =
      $(this).attr("data-origin") == "agendamento"
        ? ".horario_agend"
        : ".horario_visita";
    $(horario).html("<option>Aguarde...</option>");
    $.ajax({
      url: "./listar-horarios-visita",
      type: "POST",
      dataType: "json",
      data: {
        unidade: unidade,
        data: data,
      },
    })
      .done(function (data) {
        if (data.length > 0) {
          $(horario).html("");
          $(horario).append("<option value='' ></option>");
          data.forEach(function (element) {
            $(horario).append(
              "<option value='" + element + "' >" + element + "</option>"
            );
          });
        } else {
          $(horario).html("");
          $(horario).append("<option value=''>Horários indisponíveis</option>");
        }
      })
      .fail(function (e) {
        $(horario).html("<option>Horários indisponíveis</option>");
      });
  });

  $("#nr_filhos").change(function () {
    let num = $(this).val();
    if (num != "") {
      $("#boxTbodyAlunoSerie").html("");
      for (let i = 1; i <= num; i++) {
        $("#boxTbodyAlunoSerie").append(
          "<tr><td width='50%'><input type='text' name='alunoPreinscricao" +
            i +
            "' class='form-control alunoInsc' /></td><td width='50%'><select name='seriePreinscricao" +
            i +
            "' class='form-control serieInsc' >" +
            seriesSelect +
            "</select></td></tr"
        );
      }
      $("#tabelaAlunosSerie").show();
      $("#btEnviar").prop("disabled", false);
    } else {
      $("#tabelaAlunosSerie").hide();
      $("#btEnviar").prop("disabled", true);
    }
  });

  setTimeout(function () {
    $("#unidade_id").trigger("change");
  }, 1000);

  $("#unidade_id").change(function () {
    var unidade;
    var und = $(this).val().split("-");
    unidade = und[1];

    if (unidade != "") {
      preencherMaisInfoUnidade(unidade);
      buscarDatasDisponiveisAgendamentoDocumento(unidade);

      $.ajax({
        url: "./listar-series-por-unidade",
        type: "GET",
        dataType: "json",
        data: { unidade: unidade },
      })
        .done(function (data) {
          seriesSelect = "<option value=''></option>";
          data.forEach(function (data) {
            turnoAux = data.ds_turno != "" ? " - " + data.ds_turno : "";
            seriesSelect +=
              "<option value='" +
              data.nm_serie +
              " - " +
              data.ds_turno +
              "|" +
              data.id +
              "'>" +
              data.nm_serie +
              turnoAux +
              "</option>";
          });
        })
        .fail(function (data) {
          seriesSelect = "<option value=''>erro</option>";
        });
      $("#nr_filhos").prop("disabled", false);
      $("#tabelaAlunosSerie").hide();
      $("#boxTbodyAlunoSerie").html("");
      $("#nr_filhos").val("");
    } else {
      $(".comoChegar").hide();
      $("#nr_filhos").prop("disabled", true);
    }
  });
});
