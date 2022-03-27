jQuery(($) => {

    $.ajax({
        url: 'https://www.cbr-xml-daily.ru/latest.js',
        success: function (data) {
            var test = JSON.parse(data);

            function converter_1() {
                if ($("#select_1").val() == "RUB") {
                    if ($("#select_2").val() == "RUB") {
                        answer_1 = 1 * $("#input_1").val();
                    } else {
                        answer_1 = test.rates[$("#select_2").val()] * $("#input_1").val();
                    }
                } else {
                    if ($("#select_2").val() == "RUB") {
                        answer_1 = $("#input_1").val() / test.rates[$("#select_1").val()];
                    } else {
                        answer_1 = test.rates[$("#select_1").val()] * $("#input_1").val() / test.rates[$("#select_2").val()]
                    }
                }
                $("#input_2").val(answer_1.toFixed(4));
            }

            function converter_2() {
                if ($("#select_2").val() == "RUB") {
                    if ($("#select_1").val() == "RUB") {
                        answer_2 = 1* $("#input_2").val();
                    } else {
                        answer_2 = test.rates[$("#select_1").val()] * $("#input_2").val();
                    }
                } else {
                    if ($("#select_1").val() == "RUB") {
                        answer_2 = $("#input_2").val() / test.rates[$("#select_2").val()];
                    } else {
                        answer_2 = test.rates[$("#select_2").val()] * $("#input_2").val() / test.rates[$("#select_1").val()]
                    }
                }
                $("#input_1").val(answer_2.toFixed(4));
            }

                document.getElementById("input_1").oninput = function () {
                    converter_1();
                };

                document.getElementById("input_2").oninput = function () {
                    converter_2();
                };

            //Выпадающее меню в форме обратной связи
            $('#select__head-1, #select__head-2').click(function (){
                if ($(this).hasClass('open')) {
                    $(this).removeClass('open');
                    $(this).next().fadeOut();
                } else {
                    $(this).addClass('open');
                    $(this).next().fadeIn();
                }
            });

            $('.select__item').click(function (){
                $(this).parent().prev().removeClass('open');
                $(this).parent().fadeOut();
                $(this).parent().prev().text($(".select__item:hover").prop('id'));
                $(this).parent().prev().html($(".select__item:hover").prop('id') +"<img src='src/images/select-chevron.png'>");
                $(this).parent().prev().val($(".select__item:hover").prop('id'));
                $(this).parent().prev().prev().val($(".select__item:hover").prop('id'));
                if ($(this).parent().prev().prop("id") == "select__head-1") {
                    converter_1();
                }
                else {
                    converter_2();
                }
            });

            $("#arrow_converter").click(function () {
                select_1 = $("#select__head-1").html();
                select_2 = $("#select__head-2").html();
                input_1 = $("#select_1").val();
                input_2 = $("#select_2").val();
                $("#select__head-1").html(select_2);
                $("#select__head-2").html(select_1);
                $("#select_1").val(input_2);
                $("#select_2").val(input_1);
                converter_1();

            })
        }
    })






})