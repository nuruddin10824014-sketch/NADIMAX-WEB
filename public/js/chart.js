/*
==========================================
NADIMAX ADMIN
Heart Rate Chart
==========================================
*/

document.addEventListener("DOMContentLoaded", () => {

    const canvas = document.getElementById("heartRateChart");

    if(!canvas) return;

    new Chart(canvas,{

        type:"line",

        data:{

            labels:[
                "08:00",
                "09:00",
                "10:00",
                "11:00",
                "12:00",
                "13:00",
                "14:00"
            ],

            datasets:[{

                label:"Heart Rate",

                data:[
                    72,
                    78,
                    75,
                    83,
                    79,
                    76,
                    81
                ],

                borderColor:"#2563eb",

                backgroundColor:"rgba(37,99,235,.12)",

                borderWidth:3,

                fill:true,

                tension:.4,

                pointRadius:5,

                pointHoverRadius:7

            }]

        },

        options:{

            responsive:true,

            maintainAspectRatio:true,
            aspectRatio:2,

            plugins:{

                legend:{

                    display:false

                }

            },

            scales:{

                y:{

                    beginAtZero:false,

                    suggestedMin:60,

                    suggestedMax:120,

                    grid:{

                        color:"#edf2f7"

                    }

                },

                x:{

                    grid:{

                        display:false

                    }

                }

            }

        }

    });

});