section .bss
    buf:   resb    1
    res:   resb    1
section .text
    global  _start
_start:             ; you made the label _start global,
                    ; but you forgot to add the label.
_read:
    mov     eax, 3      ; sys_read
    mov     ebx, 0      ; stdin
    mov     ecx, buf    ; buffer (memory address, where read should save 1 byte)
    mov     edx, 1      ; read byte count
    int     80h

_adding:
    mov     cl, [buf]   ; copy 1 byte (the ASCII-char) from address buf into cl
    sub     cl, '0'     ; same as "sub cl, 30h"; changes ASCII number into binary number. (This is optional)
    add     cl, 1       ; it will not work, when the result is >9!
                        ; Because then you get 2 digits
    add     cl, '0'     ; convert binary number back to ascii-char.
                        ; (This is optional)
    mov     [res], cl   ; you could use buf instead of res, too.

_write:
    mov     eax,    4           ; sys_write
    mov     ebx,    1           ; stdout
    mov     ecx,    res         ; buffer
    mov     edx,    1           ; write byte count
    int     80h

_exit:
    mov     eax,    1           ; exit
    mov     ebx,    0           ; exit status
    int     80h
