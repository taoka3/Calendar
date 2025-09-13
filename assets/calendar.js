let isClick = false;
//mouse event
document.addEventListener('mousedown', function(e){
  if (e.target.closest('.draggable') && !e.target.closest('.lock')) {
    document.onselectstart = () => false;
    if(e.buttons === 1){
        isClick = true;
        changeLog(e);
    }
  }
});

// document.addEventListener('mousemove', function(e){
//     if (e.target.closest('.draggable') && !e.target.closest('.lock')) {
//         if(isClick && e.buttons === 1){
//             changeLog(e);
//         }
//     }
// });

document.addEventListener('mouseup', function(e){
  document.onselectstart = null;
  if(e.buttons === 0){
        isClick = false;
    }
});

//change
function changeLog(e){
    if(e.target.getAttribute('data-draggable') == 'false'){
        e.target.setAttribute('data-draggable', 'true');
        e.target.classList.remove('text-gray-700');
        e.target.classList.add('text-white','bg-gray-500');
    }else{
       e.target.setAttribute('data-draggable', 'false');
       e.target.classList.remove('text-white');
       e.target.classList.remove('bg-gray-500');
       e.target.classList.add('text-gray-700');
    }    
}

//reserved
if(document.querySelector('#reservedBtn')){
    document.querySelector('#reservedBtn').addEventListener('click', function(){
        let i = 0;
        const frm = document.createElement("form");
        frm.method = "POST";
        frm.action = "reserved.php";
        document.querySelectorAll('.draggable').forEach(function(el){
            if(!el.classList.contains('lock') && el.getAttribute('data-draggable') == 'true'){
                const input = document.createElement("input");
                input.type = "hidden";
                input.name = `reservedDate[${i}]`;
                input.value = el.getAttribute('data-date');
                frm.appendChild(input);                
                i++;
            }
        });
        document.body.appendChild(frm);
        i?frm.submit():alert('予約日を選択してください');
    });
}

//reset
if(document.querySelector('#resetBtn')){
    document.querySelector('#resetBtn').addEventListener('click', function(){
        document.querySelectorAll('.draggable').forEach(function(el){
            if(!el.classList.contains('lock') && !el.classList.contains('text-gray-700')){
                el.setAttribute('data-draggable', 'false');
                el.classList.remove('text-white');
                el.classList.remove('bg-gray-500');               
                el.classList.add('text-gray-700');
            }           
        });
        alert('リセットしました');
    });
}