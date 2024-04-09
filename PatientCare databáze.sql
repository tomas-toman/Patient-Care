PGDMP              	        |           PatientCare    16.0    16.0 A    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16398    PatientCare    DATABASE     �   CREATE DATABASE "PatientCare" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Czech_Czechia.1250';
    DROP DATABASE "PatientCare";
                postgres    false            �            1259    16476    log    TABLE     }   CREATE TABLE public.log (
    id integer NOT NULL,
    data character varying(128),
    datum timestamp without time zone
);
    DROP TABLE public.log;
       public         heap    postgres    false            �            1259    16475 
   log_id_seq    SEQUENCE     �   CREATE SEQUENCE public.log_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.log_id_seq;
       public          postgres    false    230            �           0    0 
   log_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE public.log_id_seq OWNED BY public.log.id;
          public          postgres    false    229            �            1259    16442    luzka    TABLE     ~   CREATE TABLE public.luzka (
    id integer NOT NULL,
    cislo_luzka integer,
    fk_pokoj integer,
    fk_pacient integer
);
    DROP TABLE public.luzka;
       public         heap    postgres    false            �            1259    16441    luzka_id_seq    SEQUENCE     �   CREATE SEQUENCE public.luzka_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.luzka_id_seq;
       public          postgres    false    226                        0    0    luzka_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.luzka_id_seq OWNED BY public.luzka.id;
          public          postgres    false    225            �            1259    16414    oddeleni    TABLE     �   CREATE TABLE public.oddeleni (
    fk_oddeleni integer NOT NULL,
    nazev character varying(32),
    img_src character varying(128)
);
    DROP TABLE public.oddeleni;
       public         heap    postgres    false            �            1259    16413    oddeleni_id_seq    SEQUENCE     �   CREATE SEQUENCE public.oddeleni_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.oddeleni_id_seq;
       public          postgres    false    220                       0    0    oddeleni_id_seq    SEQUENCE OWNED BY     L   ALTER SEQUENCE public.oddeleni_id_seq OWNED BY public.oddeleni.fk_oddeleni;
          public          postgres    false    219            �            1259    16433    pacienti    TABLE     %  CREATE TABLE public.pacienti (
    fk_pacient integer NOT NULL,
    rodne_cislo character varying(32),
    jmeno character varying(32),
    prijmeni character varying(32),
    datum_narozeni date,
    den_hospitalizace date,
    rezim_operacni_den character varying(64),
    info_json json
);
    DROP TABLE public.pacienti;
       public         heap    postgres    false            �            1259    16432    pacienti_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pacienti_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.pacienti_id_seq;
       public          postgres    false    224                       0    0    pacienti_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.pacienti_id_seq OWNED BY public.pacienti.fk_pacient;
          public          postgres    false    223            �            1259    16421    pokoje    TABLE     q   CREATE TABLE public.pokoje (
    fk_pokoj integer NOT NULL,
    cislo_pokoje integer,
    fk_oddeleni integer
);
    DROP TABLE public.pokoje;
       public         heap    postgres    false            �            1259    16420    pokoje_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pokoje_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.pokoje_id_seq;
       public          postgres    false    222                       0    0    pokoje_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.pokoje_id_seq OWNED BY public.pokoje.fk_pokoj;
          public          postgres    false    221            �            1259    16400    pozice    TABLE     g   CREATE TABLE public.pozice (
    fk_pozice integer NOT NULL,
    nazev_pozice character varying(32)
);
    DROP TABLE public.pozice;
       public         heap    postgres    false            �            1259    16399    pozice_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pozice_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.pozice_id_seq;
       public          postgres    false    216                       0    0    pozice_id_seq    SEQUENCE OWNED BY     F   ALTER SEQUENCE public.pozice_id_seq OWNED BY public.pozice.fk_pozice;
          public          postgres    false    215            �            1259    16407    specializace    TABLE     y   CREATE TABLE public.specializace (
    fk_specializace integer NOT NULL,
    nazev_specializace character varying(32)
);
     DROP TABLE public.specializace;
       public         heap    postgres    false            �            1259    16406    specializace_id_seq    SEQUENCE     �   CREATE SEQUENCE public.specializace_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.specializace_id_seq;
       public          postgres    false    218                       0    0    specializace_id_seq    SEQUENCE OWNED BY     X   ALTER SEQUENCE public.specializace_id_seq OWNED BY public.specializace.fk_specializace;
          public          postgres    false    217            �            1259    16459    zamestnanci    TABLE       CREATE TABLE public.zamestnanci (
    id integer NOT NULL,
    jmeno character varying(32),
    prijmeni character varying(32),
    prihlasovaci_jmeno character varying(32),
    heslo character varying(256),
    fk_pozice integer,
    fk_specializace integer
);
    DROP TABLE public.zamestnanci;
       public         heap    postgres    false            �            1259    16458    zamestnanci_id_seq    SEQUENCE     �   CREATE SEQUENCE public.zamestnanci_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.zamestnanci_id_seq;
       public          postgres    false    228                       0    0    zamestnanci_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.zamestnanci_id_seq OWNED BY public.zamestnanci.id;
          public          postgres    false    227            D           2604    16479    log id    DEFAULT     `   ALTER TABLE ONLY public.log ALTER COLUMN id SET DEFAULT nextval('public.log_id_seq'::regclass);
 5   ALTER TABLE public.log ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    230    229    230            B           2604    16445    luzka id    DEFAULT     d   ALTER TABLE ONLY public.luzka ALTER COLUMN id SET DEFAULT nextval('public.luzka_id_seq'::regclass);
 7   ALTER TABLE public.luzka ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    226    226            ?           2604    16417    oddeleni fk_oddeleni    DEFAULT     s   ALTER TABLE ONLY public.oddeleni ALTER COLUMN fk_oddeleni SET DEFAULT nextval('public.oddeleni_id_seq'::regclass);
 C   ALTER TABLE public.oddeleni ALTER COLUMN fk_oddeleni DROP DEFAULT;
       public          postgres    false    220    219    220            A           2604    16436    pacienti fk_pacient    DEFAULT     r   ALTER TABLE ONLY public.pacienti ALTER COLUMN fk_pacient SET DEFAULT nextval('public.pacienti_id_seq'::regclass);
 B   ALTER TABLE public.pacienti ALTER COLUMN fk_pacient DROP DEFAULT;
       public          postgres    false    224    223    224            @           2604    16424    pokoje fk_pokoj    DEFAULT     l   ALTER TABLE ONLY public.pokoje ALTER COLUMN fk_pokoj SET DEFAULT nextval('public.pokoje_id_seq'::regclass);
 >   ALTER TABLE public.pokoje ALTER COLUMN fk_pokoj DROP DEFAULT;
       public          postgres    false    221    222    222            =           2604    16403    pozice fk_pozice    DEFAULT     m   ALTER TABLE ONLY public.pozice ALTER COLUMN fk_pozice SET DEFAULT nextval('public.pozice_id_seq'::regclass);
 ?   ALTER TABLE public.pozice ALTER COLUMN fk_pozice DROP DEFAULT;
       public          postgres    false    216    215    216            >           2604    16410    specializace fk_specializace    DEFAULT        ALTER TABLE ONLY public.specializace ALTER COLUMN fk_specializace SET DEFAULT nextval('public.specializace_id_seq'::regclass);
 K   ALTER TABLE public.specializace ALTER COLUMN fk_specializace DROP DEFAULT;
       public          postgres    false    217    218    218            C           2604    16462    zamestnanci id    DEFAULT     p   ALTER TABLE ONLY public.zamestnanci ALTER COLUMN id SET DEFAULT nextval('public.zamestnanci_id_seq'::regclass);
 =   ALTER TABLE public.zamestnanci ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    227    228    228            �          0    16476    log 
   TABLE DATA           .   COPY public.log (id, data, datum) FROM stdin;
    public          postgres    false    230   vG       �          0    16442    luzka 
   TABLE DATA           F   COPY public.luzka (id, cislo_luzka, fk_pokoj, fk_pacient) FROM stdin;
    public          postgres    false    226   I       �          0    16414    oddeleni 
   TABLE DATA           ?   COPY public.oddeleni (fk_oddeleni, nazev, img_src) FROM stdin;
    public          postgres    false    220   L       �          0    16433    pacienti 
   TABLE DATA           �   COPY public.pacienti (fk_pacient, rodne_cislo, jmeno, prijmeni, datum_narozeni, den_hospitalizace, rezim_operacni_den, info_json) FROM stdin;
    public          postgres    false    224   �L       �          0    16421    pokoje 
   TABLE DATA           E   COPY public.pokoje (fk_pokoj, cislo_pokoje, fk_oddeleni) FROM stdin;
    public          postgres    false    222   RP       �          0    16400    pozice 
   TABLE DATA           9   COPY public.pozice (fk_pozice, nazev_pozice) FROM stdin;
    public          postgres    false    216   LQ       �          0    16407    specializace 
   TABLE DATA           K   COPY public.specializace (fk_specializace, nazev_specializace) FROM stdin;
    public          postgres    false    218   �Q       �          0    16459    zamestnanci 
   TABLE DATA           q   COPY public.zamestnanci (id, jmeno, prijmeni, prihlasovaci_jmeno, heslo, fk_pozice, fk_specializace) FROM stdin;
    public          postgres    false    228   �R                  0    0 
   log_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.log_id_seq', 26, true);
          public          postgres    false    229                       0    0    luzka_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.luzka_id_seq', 276, true);
          public          postgres    false    225            	           0    0    oddeleni_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.oddeleni_id_seq', 14, true);
          public          postgres    false    219            
           0    0    pacienti_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.pacienti_id_seq', 43, true);
          public          postgres    false    223                       0    0    pokoje_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.pokoje_id_seq', 92, true);
          public          postgres    false    221                       0    0    pozice_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.pozice_id_seq', 9, true);
          public          postgres    false    215                       0    0    specializace_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.specializace_id_seq', 19, true);
          public          postgres    false    217                       0    0    zamestnanci_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.zamestnanci_id_seq', 5, true);
          public          postgres    false    227            T           2606    16481    log log_pkey 
   CONSTRAINT     J   ALTER TABLE ONLY public.log
    ADD CONSTRAINT log_pkey PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.log DROP CONSTRAINT log_pkey;
       public            postgres    false    230            P           2606    16447    luzka luzka_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.luzka
    ADD CONSTRAINT luzka_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.luzka DROP CONSTRAINT luzka_pkey;
       public            postgres    false    226            J           2606    16419    oddeleni oddeleni_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.oddeleni
    ADD CONSTRAINT oddeleni_pkey PRIMARY KEY (fk_oddeleni);
 @   ALTER TABLE ONLY public.oddeleni DROP CONSTRAINT oddeleni_pkey;
       public            postgres    false    220            N           2606    16440    pacienti pacienti_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.pacienti
    ADD CONSTRAINT pacienti_pkey PRIMARY KEY (fk_pacient);
 @   ALTER TABLE ONLY public.pacienti DROP CONSTRAINT pacienti_pkey;
       public            postgres    false    224            L           2606    16426    pokoje pokoje_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.pokoje
    ADD CONSTRAINT pokoje_pkey PRIMARY KEY (fk_pokoj);
 <   ALTER TABLE ONLY public.pokoje DROP CONSTRAINT pokoje_pkey;
       public            postgres    false    222            F           2606    16405    pozice pozice_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.pozice
    ADD CONSTRAINT pozice_pkey PRIMARY KEY (fk_pozice);
 <   ALTER TABLE ONLY public.pozice DROP CONSTRAINT pozice_pkey;
       public            postgres    false    216            H           2606    16412    specializace specializace_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.specializace
    ADD CONSTRAINT specializace_pkey PRIMARY KEY (fk_specializace);
 H   ALTER TABLE ONLY public.specializace DROP CONSTRAINT specializace_pkey;
       public            postgres    false    218            R           2606    16464    zamestnanci zamestnanci_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_pkey;
       public            postgres    false    228            V           2606    16453    luzka luzka_fk_pacient_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.luzka
    ADD CONSTRAINT luzka_fk_pacient_fkey FOREIGN KEY (fk_pacient) REFERENCES public.pacienti(fk_pacient);
 E   ALTER TABLE ONLY public.luzka DROP CONSTRAINT luzka_fk_pacient_fkey;
       public          postgres    false    4686    224    226            W           2606    16448    luzka luzka_fk_pokoj_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.luzka
    ADD CONSTRAINT luzka_fk_pokoj_fkey FOREIGN KEY (fk_pokoj) REFERENCES public.pokoje(fk_pokoj);
 C   ALTER TABLE ONLY public.luzka DROP CONSTRAINT luzka_fk_pokoj_fkey;
       public          postgres    false    4684    226    222            U           2606    16427    pokoje pokoje_fk_oddeleni_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pokoje
    ADD CONSTRAINT pokoje_fk_oddeleni_fkey FOREIGN KEY (fk_oddeleni) REFERENCES public.oddeleni(fk_oddeleni);
 H   ALTER TABLE ONLY public.pokoje DROP CONSTRAINT pokoje_fk_oddeleni_fkey;
       public          postgres    false    220    222    4682            X           2606    16465 &   zamestnanci zamestnanci_fk_pozice_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_fk_pozice_fkey FOREIGN KEY (fk_pozice) REFERENCES public.pozice(fk_pozice);
 P   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_fk_pozice_fkey;
       public          postgres    false    216    228    4678            Y           2606    16470 ,   zamestnanci zamestnanci_fk_specializace_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_fk_specializace_fkey FOREIGN KEY (fk_specializace) REFERENCES public.specializace(fk_specializace);
 V   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_fk_specializace_fkey;
       public          postgres    false    218    4680    228            �   |  x���?n�0��S�I���[�nU��]�`)����:p��'�	��r�Z%M��jS	�ħ�Ͽ�&+��US!s����6��<Nf�i0�l�0"�`\� �����z/��vr����N5���j�J�4o��Iڰ��!��\�l׼�Q���9,��n#�����X(��P�7��,�Vw�3yD�>t���>ks��ڙHe�%�T^�K�"Y�u]��m!��1gJ�~��E&��2UM��F�C]
n��;�Q���ع��'7�&@��{^B}�_=CF���qW���Dps>#Y���0���o�!��'�Eρ�a�1�7] ��WS�Ds7Љ?����qS�M���q;��j-��3}���fv:�o0<|�i�3 ��]�      �   �  x�=�˕A���`���=I8��V�>_p��ȑ�>����ߟ��/�)n����3~y0�ē�bƼ���Ì�2c~�9��a�ܘ1wf�x0c�̘3�x3c>̘�w�}��w�|��L��:�Όy0c��t�bƼ�)n���ӕ�7(��5�Kx]��������3��T���E�x��X��U��_M#����Kv����U�ʭ�@ї=�Edn�Ie� ���MQ*��	IԪ� ��LFB��2He$�pR�U�I.#��kUgR�H2�±��B҈��^BM�Fӈf/���Mc]�.�nAX� D���Fӈ���K�iDӈf/���M#���"Wb�L��I�����K1r*���r+F��H�^�.%��4RrT�KI�KI#%G5{)i��������4RR��y�$�4��%��H��W�V�0�9���0j��
�����,�<���s\��o3��z����0��z����0�S��0�aܧ'�a�øO9N�ø���z�,ּ�l�ծ&f�a�f�K������o��K=��t6o:/��t�9\����\�f:/��t�9L神��a:�����9Lg��V�K�0}����p��O�>[.}��1������'L�0}�:��	�'���w�a�øo}�<��qsc[�)7�����ї�Í�7���ww�a��a��!�O�>�N���?�>a���s����'L�0�s��s?a��<���U������'�a|��&�a|����g��f��L�&W�&a��������6.��      �   �   x�}�M�0�׏Sp����DPSQW�i���T0ѫxϡ�(���73/f�������2�C�!��'�(�#_�aa�K�R���ѐ��`��q�EMu�}���'7)\��F,�����3�\��R��!`v���hD��H�`�إ+;�<�uO���/Y8'`T�3��.�,�Z�h~K��F�Ö���Kd�W�tp��Ӵ���D� EQ�0���      �   L  x��V�N�0�N��ʵ;委vwc�4�@H�]L���b��QbWk��@��x�	}��i�R6m��T���?�k�����ƻC�M	�$���9ޠ�}ߵ�#��y���X�x�A}[�X���X��=�O�n7��?���p� �u�����1ɭC��� v��������[���W���1#\̉���SQ��$���Z�G�Ȉ�]1�Uic���6I��� {�m��i��↡���7��"d�W"��I�E%���D��]�NE�8KI�Dx,J%-n��w�	+(��/vV�I��4�߁�3��l��e}�xx��FK�*�����,S���bg��O'���p���
WI��6��LYL3^�bB�x&�J�b��T��iN��;�Pd�O�d�n]���W�4�8= ����/�%5��dB%�=ҷ�T��K�D��
�F�.���@;��h�Q3�/���Qƌ�s	}}��I����澿x�oP{٬����F����^Fc+/�H�\�Dl���}��.��������T�d�%P[KoھZ����@9���Y�!(�ʡ1�~��e��h���3�h�������J�Z��$U��6��G��
G�9Ε)�h�l��8�W�5���9m���S%���ѧoM�(��c������6!�'��p�W�6_T�B�����iڰt/��:=G���&��K�c��S�eܼ5�����Fh��\K��z$U�@�!�z���W�im��>CCt$Kߤ�-���h�����ї<y8Yo@���������0�}��#G�{���(R��rD�fP�@!�.]���9�0��^����[V�
      �   �   x��K��0����L�|Hr�w�s��ƢL'ȦZ�Jo�:ڠ�6��-��^�&�s��\2=�E
tb��m�x#Ipi��&  x��`r���ҹJl������xH�ۛ�5Pog�ܙ��L]�.�ψ�e�pP�f)
��@�z�4�*J�V��o���'�6
��B����X��K�nU:C�l��N!Cj^3Gu��T^j/gc���"6M�����g�CW���������z�J      �   �   x�3��9�2;��L.#Ψ��Ĳ����k�S�K����b��ه�*��&g�efs�p:��f�e��d��t���^��e���Rpt}QPB،�-�(719��bXAQbr>Ho6�9gHjQbP�˂38?9�l(B�%�g�i1z\\\ EIK5      �   �   x�]�MN�@�מS�����?U �B�b�$CcM≜)R��X���bHR$X���{�.s���Ȩ	<1�ほ6*�O��C�ߺVM�ac]�-¨r�2��g�5��@���ڛw�j���%�_?�2�]˨V{'Į@ix7װ��4������GUk���M�RRzל9۳�b�
Ya�A�����	������PA� /�'!P���Kx�'�v+�C��Q�a�^ΔR߭C~O      �   �   x�-�M�0D�_����
"�D��Q0qSѐ�OA�AO#g!�K4nf޼�Px���v���I�޵P�^��A��gƖ3���C������koN��-��fMn�)�rL��(�1B$.]�n�ͯ ������X�$��r���¢���u������W,uio4�
�*�ׅN�%�@L�SB��?�     