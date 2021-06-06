<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script type="text/javascript">
var campaigns = null;
var base_url = "{{ url('/') }}";
var condition_list = {
    !!json_encode($conditions) !!
}
var subcondition_list = {
    !!json_encode($subconditions) !!
}
var test_types = {
    !!json_encode($testTypes) !!
}
var saved_campaigns = {
    !!json_encode($savedCampaigns) !!
}
var show_keydate_campaigns = {
    !!json_encode($showKeydateCampaigns ?? '') !!
}
var patient = {
    !!json_encode($patient) !!
}
var typeOptions = "";
var global_campaigns = {
    !!json_encode($global_campaigns) !!
}
var flg_global_campaigns = [];
var keydates = {
    !!json_encode($keydates) !!
};
for (var i = 0; i < global_campaigns.length; i++) {
    obj = {};
    obj.flg = 0;
    obj.id = global_campaigns[i].id;
    flg_global_campaigns.push(obj);
}

let elements = document.querySelectorAll("[data-menu]");
for (let i = 0; i < elements.length; i++) {
    let main = elements[i];
    main.addEventListener("click", function() {
        let element = main.parentElement.parentElement;
        let andicators = main.querySelectorAll("svg");
        let child = element.querySelector("ul");
        if (child.classList.contains("opacity-0")) {
            child.classList.remove("invisible");
            child.classList.add("visible");
            child.classList.add("opacity-100");
            child.classList.remove("opacity-0");
            andicators[0].style.display = "block";
            andicators[1].style.display = "none";
        } else {
            child.classList.add("invisible");
            child.classList.remove("visible");
            child.classList.remove("opacity-100");
            child.classList.add("opacity-0");
            andicators[0].style.display = "none";
            andicators[1].style.display = "block";
        }
    });
}
var tableDetails = document.getElementsByClassName("detail-row");
for (var i = 0; i < tableDetails.length; i++) {
    $(this).classList.add('hidden')
}

function dropdownFunction(element) {
    var single = element.getElementsByClassName("dropdown-content")[0];
    single.classList.toggle("hidden");
}

function accordionHandler(element) {
    var next_element = element.parentElement.parentElement.parentElement.nextElementSibling;

    while (next_element) {
        if (!$(next_element).hasClass('detail-row'))
            break;
        next_element.children[0].classList.toggle("hidden")
        next_element.children[1].classList.toggle("hidden")
        next_element.children[2].classList.toggle("hidden")
        next_element.children[3].classList.toggle("hidden")
        next_element.children[4].classList.toggle("hidden")
        next_element.children[5].classList.toggle("hidden")
        next_element.children[6].classList.toggle("hidden")
        next_element.children[7].classList.toggle("hidden")
        next_element.children[8].classList.toggle("hidden")
        next_element.children[9].classList.toggle("hidden")
        next_element.children[10].classList.toggle("hidden")
        next_element.children[11].classList.toggle("hidden")

        next_element = next_element.nextElementSibling

    }
}

function tableInteract(element) {
    var single = element.parentElement.parentElement.parentElement;
    single.classList.toggle("bg-gray-100");
}

function checkAll(element) {
    let rows = element.parentElement.parentElement.parentElement.parentElement.nextElementSibling.children;
    for (var i = 0; i < rows.length; i++) {
        if (element.checked) {
            rows[i].classList.add("bg-gray-100");
            let checkbox = rows[i].getElementsByTagName("input")[0];
            if (checkbox) {
                checkbox.checked = true;
            }
        } else {
            rows[i].classList.remove("bg-gray-100");
            let checkbox = rows[i].getElementsByTagName("input")[0];
            if (checkbox) {
                checkbox.checked = false;
            }
        }
    }
}
</script>
<script src="{{ asset('js/patient.js') }}"></script>