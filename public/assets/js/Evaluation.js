$(document).ready(function(){

    $("#evaluations-table").DataTable({
        "scrollY": "400px",
        "scrollCollapse": true,
    });

    $('a.create').click(function (){
        clearForm();
    });

    //Function to calculate the final score.
function calculateFinalScore(totalRef, subScoreTotalRef) {
    let finalScore = 0;
    let count = 0;
    $(totalRef + " " + subScoreTotalRef).each(function () {
        finalScore += parseInt($(this).html());
        count++;
    });

    //Display the final score as a percentage value
    $("#total_score").val(convertPercentage(finalScore, 100 * count));
    return convertPercentage(finalScore, 100 * count);
}

//Function to set the Failed label
function setLabelFailed(label) {
    label.removeClass("alert-success").addClass("alert-danger");
    label.css("font-weight", "bold");
    label.html("Failed");
}

//Function to set the Passed label
function setLabelSuccess(label) {
    label.removeClass("alert-danger").addClass("alert-success");
    label.css("font-weight", "bold");
    label.html("Passed");
}

function setPointsAchieved(pointsElement, targetElement) {
    let pointsValue = $(pointsElement).val();
    $(targetElement).val(pointsValue);
    $(targetElement).attr("value", pointsValue);
}

function setPointsAchievedZero(targetElement) {
    $(targetElement).val(0);
    $(targetElement).attr("value", 0);
}

function convertPercentage(value, totalValue) {
    return parseInt((value / totalValue) * 100);
}

function calculatePoints(subScoreRef, achievedRef, totalRef) {
    let value = 0;
    let totalValue = 0;
    $(subScoreRef + " " + achievedRef).each(function () {
        value += parseInt($(this).val());
    });
    $(subScoreRef + " " + totalRef).each(function () {
        totalValue += parseInt($(this).val());
    });

    return convertPercentage(value, totalValue);
}

//Function that will return the value of Critical elements for the Final Score
function calculateDataCriticalPoints(isCriticalPerformNo) {
    if (isCriticalPerformNo) { //If there is even one element in Critical section that selected as 'NO', it will return 0.
        return 0;
    } else {
        return 100;
    }
}

    $("body").on("change", "[action='perform']", function () {
        let ref = $(this).attr("ref");
        let perform_action = $(this).children("option:selected").attr("value");
        let performYes = perform_action === "yes";
        let performNo = perform_action === "no";
        let performNa = perform_action === "na";

        let finalScoreRef = $("[ref='final']");
        let totalRef = "[ref='total']";
        let subScoreTotalRef = ".total";
        let subScoreId = $(this).attr("categoryId");
        let subScoreRef = "#category-" + subScoreId;
        let achievedRef = ".points_achieved_criterias";
        let pointRef = ".points_criterias";
        let totalSubScoreRef = $("[ref='category-" + subScoreId + "']");
        let isDataCritical = $(this).attr("data-critical") === "1";

        let passLabel = $("#passlabel");
        let passRate = $('#passrate').val();

        // Check if perform "no" is existed for final score
        let isCriticalPerformNo = false;
        $(".custom-select[data-critical='1']").each(function () {
            if ($(this).val() === "no") {
                isCriticalPerformNo = true;
                return false
            }
            isCriticalPerformNo = false;
        });

        // Set Points Achieved
        if (performYes || performNa) {
            setPointsAchieved('#points_criterias_' + ref, '#points_achieved_criterias_' + ref);
        }
        if (performNo) {
            setPointsAchievedZero('#points_achieved_criterias_' + ref);
        }

        // Calculate Total Sub Score and render to "ref='main-...'"
        if (isDataCritical) { // Use different function to calculate data-critical="yes"
            totalSubScoreRef.html(calculateDataCriticalPoints(isCriticalPerformNo) + "%");
        } else {
            totalSubScoreRef.html(calculatePoints(subScoreRef, achievedRef, pointRef) + "%");
        }

        // Calculate and Render Final Score
        if ((isDataCritical && performNo) || //if the element is critical and selected 'No'
            (isDataCritical && performYes && isCriticalPerformNo) || //if element is not critical and selected 'Yes' and at least one critical element selected 'No'
            (!isDataCritical && (performYes || performNa || performNo) && isCriticalPerformNo) || //if element is not critical and selected 'Yes', 'No', or 'NA' and at least one critical element is selected 'No'
            !isDataCritical && isCriticalPerformNo //if element is not critical and at least one critical element selected 'No'
        ) {
            finalScoreRef.html("0%");
            $("#total_score").val(0);
            setLabelFailed(passLabel);
        } else {
            // Calculate Final Score

            let finalScore = calculateFinalScore(totalRef, subScoreTotalRef);
            if ((finalScore >= passRate) && !isCriticalPerformNo) {
                setLabelSuccess(passLabel);
            } else {
                setLabelFailed(passLabel);
            }
            // Render Final Score
            finalScoreRef.html(finalScore + "%");

        }

    });
    
});