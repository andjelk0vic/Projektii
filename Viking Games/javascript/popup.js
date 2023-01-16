/* modal 1*/ 
const openModalButtons=document.querySelectorAll('[data-modal-target]')
const closeModalButtons=document.querySelectorAll('[data-close-button]')
const overlay=document.getElementById('overlay')

openModalButtons.forEach(button=>{
    button.addEventListener('click', ()=>{
        const modal=document.querySelector(button.dataset.modalTarget)
        openModal(modal)
    })
})

closeModalButtons.forEach(button=>{
    button.addEventListener('click', ()=>{
        const modal=button.closest('.modal')
        closeModal(modal)
    })
})

function openModal(modal) {
    if(modal==null) return
    modal.classList.add('active')
    overlay.classList.add('active')

}

function closeModal(modal) {
    if(modal==null) return
    modal.classList.remove('active')
    overlay.classList.remove('active')
}
/*kraj modala1*/ 

/* modal 2*/ 

const openModalButtons2=document.querySelectorAll('[data-modal-target]')
const closeModalButtons2=document.querySelectorAll('[data-close-button]')
const overlay2=document.getElementById('overlay')

openModalButtons2.forEach(button=>{
    button.addEventListener('click', ()=>{
        const modal2=document.querySelector(button.dataset.modalTarget)
        openModal(modal2)
    })
})

closeModalButtons2.forEach(button=>{
    button.addEventListener('click', ()=>{
        const modal2=button.closest('.modal2')
        closeModal(modal2)
    })
})

function openModal2(modal2) {
    if(modal2==null) return
    modal2.classList.add('active')
    overlay.classList.add('active')

}

function closeModal2(modal2) {
    if(modal2==null) return
    modal2.classList.remove('active')
    overlay.classList.remove('active')
}
/*kraj modala2*/ 

/* modal 3*/ 

const openModalButtons3=document.querySelectorAll('[data-modal-target]')
const closeModalButtons3=document.querySelectorAll('[data-close-button]')
const overlay3=document.getElementById('overlay')

openModalButtons3.forEach(button=>{
    button.addEventListener('click', ()=>{
        const modal3=document.querySelector(button.dataset.modalTarget)
        openModal(modal3)
    })
})

closeModalButtons3.forEach(button=>{
    button.addEventListener('click', ()=>{
        const modal3=button.closest('.modal3')
        closeModal(modal3)
    })
})

function openModal3(modal3) {
    if(modal3==null) return
    modal3.classList.add('active')
    overlay.classList.add('active')

}

function closeModal3(modal3) {
    if(modal3==null) return
    modal3.classList.remove('active')
    overlay.classList.remove('active')
}
/*kraj modala3*/ 

/* modal 4*/ 

const openModalButtons4=document.querySelectorAll('[data-modal-target]')
const closeModalButtons4=document.querySelectorAll('[data-close-button]')
const overlay4=document.getElementById('overlay')

openModalButtons4.forEach(button=>{
    button.addEventListener('click', ()=>{
        const modal4=document.querySelector(button.dataset.modalTarget)
        openModal(modal4)
    })
})

closeModalButtons4.forEach(button=>{
    button.addEventListener('click', ()=>{
        const modal4=button.closest('.modal4')
        closeModal(modal4)
    })
})

function openModal4(modal4) {
    if(modal4==null) return
    modal4.classList.add('active')
    overlay.classList.add('active')

}

function closeModal4(modal4) {
    if(modal4==null) return
    modal4.classList.remove('active')
    overlay.classList.remove('active')
}
/*kraj modala4*/ 

