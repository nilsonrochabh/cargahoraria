$(function () {
    var resultado = "";

    const btEnviarPreinscricao = $(":submit");
    const loaderPreinscricao = $(".loaderPreinscricao");
    const loaderBolsa = $(".loaderBolsa");
    const loaderVisita = $(".loaderVisita");
    const btEnviarBolsa = $(".btBolsa");
    const btEnviarAgendamento = $(":submit");
    const seriesSelect = "";

    $(".boxRendaAcima").hide();

    $(".btCadPreinscricao").click(function () {
        $(".boxOptions").slideUp("slow");
        $("#boxPreinscricao").fadeIn("slow");
        $("#boxPreinscricaoAcomp").hide();
    });

    $(".btTelaEscolha").click(function () {
        $(".boxOptions").fadeIn("slow");
        $("#boxPreinscricao").hide();
        $("#boxPreinscricaoAcomp").hide();
    });

    $("#formPreinscricao2021").on("submit", function (e) {
        $("#comoConheceu").val($("#ds_conheceu").val().join(","));
        e.preventDefault();

        btEnviarPreinscricao.prop("disabled", true);
        loaderPreinscricao.show();
        $("#opsPreinscricao").hide();

        let alunosInsc = [];
        $.map($("#boxTbodyAlunoSerie .alunoInsc"), function (element) {
            alunosInsc.push($(element).val());
        });

        let serieInsc = [];
        $.map($("#boxTbodyAlunoSerie .serieInsc"), function (element) {
            serieInsc.push($(element).val());
        });

        const alunos = [];
        for (let i = 0; i < alunosInsc.length; i++) {
            let objAluno = {
                aluno: alunosInsc[i],
                serie: serieInsc[i],
            };
            alunos.push(objAluno);
        }

        if (alunos.length == 0) {
            $("#retornoSeriesAlunos").text(
                "Escolha pelo menos um aluno e série para continuar."
            );
            btEnviarPreinscricao.prop("disabled", false);
            loaderPreinscricao.hide();
        } else {
            var und = $("#unidade_id").val().split("-");
            var unidade_id = und[1];
            $.ajax({
                type: "POST",
                url: "./fazer-preinscricao",
                data: {
                    nm_responsavel: $("#nm_responsavel").val(),
                    ds_email: $("#ds_email").val(),
                    ds_celular: $("#ds_celular").val(),
                    ds_celular2: $("#ds_celular2").val(),
                    unidade_id: unidade_id,
                    ds_conheceu: $("#ds_conheceu").val(),
                    nr_filhos: $("#nr_filhos").val(),
                    alunos: alunos,
                },
                dataType: "json",
            })
                .done(function (response) {
                    if (!response.erro) {
                        sessionStorage.setItem('objPrematricula',JSON.stringify(response));
                        location.href = $("#urlBase").val()+"/pre-inscricao-cadastro-sucesso";
                        // btEnviarPreinscricao.prop("disabled", false);
                        // loaderPreinscricao.hide();

                        // $("#emailBolsa").attr("value", $("#ds_email").val());
                        // $("#emailVisita").attr("value", $("#ds_email").val());
                        // $("#emailDocumento").attr(
                        //     "value",
                        //     $("#ds_email").val()
                        // );
                        // $("#unidadeBolsa").attr(
                        //     "value",
                        //     $("#unidade_id").val()
                        // );
                        // $("#unidadeVisita").attr(
                        //     "value",
                        //     $("#unidade_id").val()
                        // );
                        // $("#unidadeDocumento").attr(
                        //     "value",
                        //     $("#unidade_id").val()
                        // );

                        // $("#informacoesPreinscricao").show();
                        // preencherPrematricula(
                        //     response.prematricula,
                        //     response.seriesOfertadasParaBolsa,
                        //     response.seriesOfertadasParaBolsa2Chamada
                        // );

                        // $("#formPreinscricao2021").slideUp("slow");
                        // $("#boxPreinscricaoConfirmada").show();
                        // $(".boxAgendamentoVisitaCadastro").show();

                        // $(".informativoBolsaSocial").hide();

                        // // if (response.isOfertaBolsa == true || response.isOfertaBolsa2Chamada == true)
                        // if (response.isOfertaBolsa2Chamada)
                        //     $(".informativoBolsaSocial").show();

                        // $("#idPrematricula").val(response.prematricula["id"]);

                    } else if (response.erro) {
                        $("#opsPreinscricao")
                            .html("<small>" + response.mensagem + "</small>")
                            .show();
                        loaderPreinscricao.hide();
                        btEnviarPreinscricao.prop("disabled", false);
                    }
                })
                .fail(function (error) {
                    $("#opsPreinscricao").show();
                    loaderPreinscricao.hide();
                    btEnviarPreinscricao.prop("disabled", false);
                });
        }
    });

    $(".btVerificarRendaMinima").click(function () {
        const nr_pessoas_familia = $("#nr_pessoas_familia").val();
        const ds_renda_familiar = retirarPontoMoeda(
            $("#ds_renda_familiar").val()
        );
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
            loaderBolsa.hide();
            btEnviarBolsa.prop("disabled", false);
        }
    });

    $("#formBolsa2020").on("submit", function (e) {
        $(".boxRendaAcima").hide();
        e.preventDefault();

        btEnviarBolsa.prop("disabled", true);
        loaderBolsa.show();
        const dadosBolsa = $(this).serialize();
        $.ajax({
            url: "./cadastrar-bolsa",
            type: "POST",
            dataType: "json",
            data: dadosBolsa + "&id_prematricula=" + $("#idPrematricula").val(),
        })
            .done(function (data) {
                if (!data.erro) {
                    $(".boxBolsaSocial").slideUp("slow");
                    $("#boxBolsaSocialConfirmado").show();
                    $(".informativoBolsaSocial").hide();

                    $("#idBolsa").val(data.bolsa.id);
                    buscarDatasDisponiveisAgendamentoDocumento(
                        data.bolsa.unidade_id
                    );

                    listarAgendamentoDoc(data.bolsa.agendamentodoc);
                } else if (data.erro) {
                    $(".opsBolsa")
                        .html(
                            '<small class="text-danger">' +
                                data.mensagem +
                                "</small>"
                        )
                        .show();
                }
                loaderBolsa.hide();
                btEnviarBolsa.prop("disabled", false);
            })
            .fail(function (data) {
                $(".opsBolsa").show();
                loaderBolsa.hide();
                btEnviarBolsa.prop("disabled", false);
            });
    });
});
