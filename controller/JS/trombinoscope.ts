const modal:HTMLDialogElement|null= document.querySelector("#modal");
const persons:Array<HTMLElement> = Array.from(document.querySelectorAll(".person"));
const usersH3:Array<HTMLElement> = Array.from(document.querySelectorAll(".person > h3"));

for(let i = 0;i<persons.length;i++) {
    persons[i].addEventListener("click", () => {
            let id_user = usersH3[i].id ;                
            window.location.href = "./?arg="+id_user;
    });
};
