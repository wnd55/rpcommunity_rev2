var ctx1 = document.getElementById('chart1').getContext('2d');
var ctx2 = document.getElementById('chart2').getContext('2d');
var ctx3 = document.getElementById('chart3').getContext('2d');


var meter = {

    cold1: 'cold1',
    cold2: 'cold2',
    cold3: 'cold3',
    hot1: 'hot1',
    hot2: 'hot2',
    hot3: 'hot3'

};

var dateValue = function () {
    var data = [];
    for (var i = 1; i < waterConsumption.length; ++i) {

        data.push(waterConsumption[i]['date'].slice(0, 10));
    }

    return data;
};

var dataWaterMeters = function (waterMeter) {

    var data = [];

    for (var i = 1; i < waterConsumption.length; ++i) {

        data.push((parseInt(waterConsumption[i][waterMeter]) - parseInt(waterConsumption[i - 1][waterMeter])));
    }

    return data;
};


var chart = new Chart(ctx1, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
    data: {
        labels: dateValue(),
        datasets: [
            {
                label: 'ГВС1 ' + waterConsumption[0]['wmhot1'],
                fill: false,
                borderColor: '#FF6384',
                backgroundColor: '#FF6384',
                data: dataWaterMeters(meter.hot1)
            },
            {
                label: 'ХВС1 ' + waterConsumption[0]['watermeter_id'],
                fill: false,
                borderColor: '#3071a9',
                backgroundColor: '#3071a9',
                data: dataWaterMeters(meter.cold1)
            }

        ]
    },

    options: {}
});

new Chart(ctx2, {

    type: 'line',
    data: {
        labels: dateValue(),
        datasets: [
            {
                label: 'ГВС2 ' + waterConsumption[0]['wmhot2'],
                fill: false,
                borderColor: '#FF6384',
                backgroundColor: '#FF6384',
                data: dataWaterMeters(meter.hot2)
            },
            {
                label: 'ХВС2 ' + waterConsumption[0]['wmcold2'],
                fill: false,
                borderColor: '#3071a9',
                backgroundColor: '#3071a9',
                data: dataWaterMeters(meter.cold2)
            }

        ]
    },

    options: {}

});

if (waterConsumption[0]['wmhot3'] !== 0) {
    new Chart(ctx3, {

        type: 'line',
        data: {
            labels: dateValue(),
            datasets: [
                {
                    label: 'ГВС3 ' + waterConsumption[0]['wmhot3'],
                    fill: false,
                    borderColor: '#FF6384',
                    backgroundColor: '#FF6384',
                    data: dataWaterMeters(meter.hot3)
                },
                {
                    label: 'ХВС3 ' + waterConsumption[0]['wmcold3'],
                    fill: false,
                    borderColor: '#3071a9',
                    backgroundColor: '#3071a9',
                    data: dataWaterMeters(meter.cold3)
                }

            ]
        },

        options: {}

    });
}