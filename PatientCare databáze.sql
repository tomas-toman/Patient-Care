PGDMP  )                    |           PatientCare    16.0    16.0 A    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16500    PatientCare    DATABASE     �   CREATE DATABASE "PatientCare" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Czech_Czechia.1250';
    DROP DATABASE "PatientCare";
                postgres    false            �            1259    16501    log    TABLE     }   CREATE TABLE public.log (
    id integer NOT NULL,
    data character varying(128),
    datum timestamp without time zone
);
    DROP TABLE public.log;
       public         heap    postgres    false            �            1259    16504 
   log_id_seq    SEQUENCE     �   CREATE SEQUENCE public.log_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.log_id_seq;
       public          postgres    false    215            �           0    0 
   log_id_seq    SEQUENCE OWNED BY     9   ALTER SEQUENCE public.log_id_seq OWNED BY public.log.id;
          public          postgres    false    216            �            1259    16505    luzka    TABLE     ~   CREATE TABLE public.luzka (
    id integer NOT NULL,
    cislo_luzka integer,
    fk_pokoj integer,
    fk_pacient integer
);
    DROP TABLE public.luzka;
       public         heap    postgres    false            �            1259    16508    luzka_id_seq    SEQUENCE     �   CREATE SEQUENCE public.luzka_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.luzka_id_seq;
       public          postgres    false    217                        0    0    luzka_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.luzka_id_seq OWNED BY public.luzka.id;
          public          postgres    false    218            �            1259    16509    oddeleni    TABLE     �   CREATE TABLE public.oddeleni (
    fk_oddeleni integer NOT NULL,
    nazev character varying(32),
    img_src character varying(128)
);
    DROP TABLE public.oddeleni;
       public         heap    postgres    false            �            1259    16512    oddeleni_id_seq    SEQUENCE     �   CREATE SEQUENCE public.oddeleni_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.oddeleni_id_seq;
       public          postgres    false    219                       0    0    oddeleni_id_seq    SEQUENCE OWNED BY     L   ALTER SEQUENCE public.oddeleni_id_seq OWNED BY public.oddeleni.fk_oddeleni;
          public          postgres    false    220            �            1259    16513    pacienti    TABLE     %  CREATE TABLE public.pacienti (
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
       public         heap    postgres    false            �            1259    16518    pacienti_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pacienti_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.pacienti_id_seq;
       public          postgres    false    221                       0    0    pacienti_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.pacienti_id_seq OWNED BY public.pacienti.fk_pacient;
          public          postgres    false    222            �            1259    16519    pokoje    TABLE     q   CREATE TABLE public.pokoje (
    fk_pokoj integer NOT NULL,
    cislo_pokoje integer,
    fk_oddeleni integer
);
    DROP TABLE public.pokoje;
       public         heap    postgres    false            �            1259    16522    pokoje_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pokoje_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.pokoje_id_seq;
       public          postgres    false    223                       0    0    pokoje_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.pokoje_id_seq OWNED BY public.pokoje.fk_pokoj;
          public          postgres    false    224            �            1259    16523    pozice    TABLE     g   CREATE TABLE public.pozice (
    fk_pozice integer NOT NULL,
    nazev_pozice character varying(32)
);
    DROP TABLE public.pozice;
       public         heap    postgres    false            �            1259    16526    pozice_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pozice_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.pozice_id_seq;
       public          postgres    false    225                       0    0    pozice_id_seq    SEQUENCE OWNED BY     F   ALTER SEQUENCE public.pozice_id_seq OWNED BY public.pozice.fk_pozice;
          public          postgres    false    226            �            1259    16527    specializace    TABLE     y   CREATE TABLE public.specializace (
    fk_specializace integer NOT NULL,
    nazev_specializace character varying(32)
);
     DROP TABLE public.specializace;
       public         heap    postgres    false            �            1259    16530    specializace_id_seq    SEQUENCE     �   CREATE SEQUENCE public.specializace_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.specializace_id_seq;
       public          postgres    false    227                       0    0    specializace_id_seq    SEQUENCE OWNED BY     X   ALTER SEQUENCE public.specializace_id_seq OWNED BY public.specializace.fk_specializace;
          public          postgres    false    228            �            1259    16531    zamestnanci    TABLE       CREATE TABLE public.zamestnanci (
    id integer NOT NULL,
    jmeno character varying(32),
    prijmeni character varying(32),
    prihlasovaci_jmeno character varying(32),
    heslo character varying(256),
    fk_pozice integer,
    fk_specializace integer
);
    DROP TABLE public.zamestnanci;
       public         heap    postgres    false            �            1259    16534    zamestnanci_id_seq    SEQUENCE     �   CREATE SEQUENCE public.zamestnanci_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.zamestnanci_id_seq;
       public          postgres    false    229                       0    0    zamestnanci_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.zamestnanci_id_seq OWNED BY public.zamestnanci.id;
          public          postgres    false    230            =           2604    16535    log id    DEFAULT     `   ALTER TABLE ONLY public.log ALTER COLUMN id SET DEFAULT nextval('public.log_id_seq'::regclass);
 5   ALTER TABLE public.log ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215            >           2604    16536    luzka id    DEFAULT     d   ALTER TABLE ONLY public.luzka ALTER COLUMN id SET DEFAULT nextval('public.luzka_id_seq'::regclass);
 7   ALTER TABLE public.luzka ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    218    217            ?           2604    16537    oddeleni fk_oddeleni    DEFAULT     s   ALTER TABLE ONLY public.oddeleni ALTER COLUMN fk_oddeleni SET DEFAULT nextval('public.oddeleni_id_seq'::regclass);
 C   ALTER TABLE public.oddeleni ALTER COLUMN fk_oddeleni DROP DEFAULT;
       public          postgres    false    220    219            @           2604    16538    pacienti fk_pacient    DEFAULT     r   ALTER TABLE ONLY public.pacienti ALTER COLUMN fk_pacient SET DEFAULT nextval('public.pacienti_id_seq'::regclass);
 B   ALTER TABLE public.pacienti ALTER COLUMN fk_pacient DROP DEFAULT;
       public          postgres    false    222    221            A           2604    16539    pokoje fk_pokoj    DEFAULT     l   ALTER TABLE ONLY public.pokoje ALTER COLUMN fk_pokoj SET DEFAULT nextval('public.pokoje_id_seq'::regclass);
 >   ALTER TABLE public.pokoje ALTER COLUMN fk_pokoj DROP DEFAULT;
       public          postgres    false    224    223            B           2604    16540    pozice fk_pozice    DEFAULT     m   ALTER TABLE ONLY public.pozice ALTER COLUMN fk_pozice SET DEFAULT nextval('public.pozice_id_seq'::regclass);
 ?   ALTER TABLE public.pozice ALTER COLUMN fk_pozice DROP DEFAULT;
       public          postgres    false    226    225            C           2604    16541    specializace fk_specializace    DEFAULT        ALTER TABLE ONLY public.specializace ALTER COLUMN fk_specializace SET DEFAULT nextval('public.specializace_id_seq'::regclass);
 K   ALTER TABLE public.specializace ALTER COLUMN fk_specializace DROP DEFAULT;
       public          postgres    false    228    227            D           2604    16542    zamestnanci id    DEFAULT     p   ALTER TABLE ONLY public.zamestnanci ALTER COLUMN id SET DEFAULT nextval('public.zamestnanci_id_seq'::regclass);
 =   ALTER TABLE public.zamestnanci ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    230    229            �          0    16501    log 
   TABLE DATA           .   COPY public.log (id, data, datum) FROM stdin;
    public          postgres    false    215   6G       �          0    16505    luzka 
   TABLE DATA           F   COPY public.luzka (id, cislo_luzka, fk_pokoj, fk_pacient) FROM stdin;
    public          postgres    false    217   �J       �          0    16509    oddeleni 
   TABLE DATA           ?   COPY public.oddeleni (fk_oddeleni, nazev, img_src) FROM stdin;
    public          postgres    false    219   �M       �          0    16513    pacienti 
   TABLE DATA           �   COPY public.pacienti (fk_pacient, rodne_cislo, jmeno, prijmeni, datum_narozeni, den_hospitalizace, rezim_operacni_den, info_json) FROM stdin;
    public          postgres    false    221   �N       �          0    16519    pokoje 
   TABLE DATA           E   COPY public.pokoje (fk_pokoj, cislo_pokoje, fk_oddeleni) FROM stdin;
    public          postgres    false    223   T       �          0    16523    pozice 
   TABLE DATA           9   COPY public.pozice (fk_pozice, nazev_pozice) FROM stdin;
    public          postgres    false    225   U       �          0    16527    specializace 
   TABLE DATA           K   COPY public.specializace (fk_specializace, nazev_specializace) FROM stdin;
    public          postgres    false    227   �U       �          0    16531    zamestnanci 
   TABLE DATA           q   COPY public.zamestnanci (id, jmeno, prijmeni, prihlasovaci_jmeno, heslo, fk_pozice, fk_specializace) FROM stdin;
    public          postgres    false    229   �V                  0    0 
   log_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.log_id_seq', 70, true);
          public          postgres    false    216                       0    0    luzka_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.luzka_id_seq', 276, true);
          public          postgres    false    218            	           0    0    oddeleni_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.oddeleni_id_seq', 14, true);
          public          postgres    false    220            
           0    0    pacienti_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.pacienti_id_seq', 47, true);
          public          postgres    false    222                       0    0    pokoje_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.pokoje_id_seq', 92, true);
          public          postgres    false    224                       0    0    pozice_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.pozice_id_seq', 9, true);
          public          postgres    false    226                       0    0    specializace_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.specializace_id_seq', 19, true);
          public          postgres    false    228                       0    0    zamestnanci_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.zamestnanci_id_seq', 6, true);
          public          postgres    false    230            F           2606    16544    log log_pkey 
   CONSTRAINT     J   ALTER TABLE ONLY public.log
    ADD CONSTRAINT log_pkey PRIMARY KEY (id);
 6   ALTER TABLE ONLY public.log DROP CONSTRAINT log_pkey;
       public            postgres    false    215            H           2606    16546    luzka luzka_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.luzka
    ADD CONSTRAINT luzka_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.luzka DROP CONSTRAINT luzka_pkey;
       public            postgres    false    217            J           2606    16548    oddeleni oddeleni_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.oddeleni
    ADD CONSTRAINT oddeleni_pkey PRIMARY KEY (fk_oddeleni);
 @   ALTER TABLE ONLY public.oddeleni DROP CONSTRAINT oddeleni_pkey;
       public            postgres    false    219            L           2606    16550    pacienti pacienti_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.pacienti
    ADD CONSTRAINT pacienti_pkey PRIMARY KEY (fk_pacient);
 @   ALTER TABLE ONLY public.pacienti DROP CONSTRAINT pacienti_pkey;
       public            postgres    false    221            N           2606    16552    pokoje pokoje_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.pokoje
    ADD CONSTRAINT pokoje_pkey PRIMARY KEY (fk_pokoj);
 <   ALTER TABLE ONLY public.pokoje DROP CONSTRAINT pokoje_pkey;
       public            postgres    false    223            P           2606    16554    pozice pozice_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.pozice
    ADD CONSTRAINT pozice_pkey PRIMARY KEY (fk_pozice);
 <   ALTER TABLE ONLY public.pozice DROP CONSTRAINT pozice_pkey;
       public            postgres    false    225            R           2606    16556    specializace specializace_pkey 
   CONSTRAINT     i   ALTER TABLE ONLY public.specializace
    ADD CONSTRAINT specializace_pkey PRIMARY KEY (fk_specializace);
 H   ALTER TABLE ONLY public.specializace DROP CONSTRAINT specializace_pkey;
       public            postgres    false    227            T           2606    16558    zamestnanci zamestnanci_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_pkey;
       public            postgres    false    229            U           2606    16559    luzka luzka_fk_pacient_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.luzka
    ADD CONSTRAINT luzka_fk_pacient_fkey FOREIGN KEY (fk_pacient) REFERENCES public.pacienti(fk_pacient);
 E   ALTER TABLE ONLY public.luzka DROP CONSTRAINT luzka_fk_pacient_fkey;
       public          postgres    false    221    217    4684            V           2606    16564    luzka luzka_fk_pokoj_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.luzka
    ADD CONSTRAINT luzka_fk_pokoj_fkey FOREIGN KEY (fk_pokoj) REFERENCES public.pokoje(fk_pokoj);
 C   ALTER TABLE ONLY public.luzka DROP CONSTRAINT luzka_fk_pokoj_fkey;
       public          postgres    false    217    4686    223            W           2606    16569    pokoje pokoje_fk_oddeleni_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pokoje
    ADD CONSTRAINT pokoje_fk_oddeleni_fkey FOREIGN KEY (fk_oddeleni) REFERENCES public.oddeleni(fk_oddeleni);
 H   ALTER TABLE ONLY public.pokoje DROP CONSTRAINT pokoje_fk_oddeleni_fkey;
       public          postgres    false    219    4682    223            X           2606    16574 &   zamestnanci zamestnanci_fk_pozice_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_fk_pozice_fkey FOREIGN KEY (fk_pozice) REFERENCES public.pozice(fk_pozice);
 P   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_fk_pozice_fkey;
       public          postgres    false    4688    229    225            Y           2606    16579 ,   zamestnanci zamestnanci_fk_specializace_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_fk_specializace_fkey FOREIGN KEY (fk_specializace) REFERENCES public.specializace(fk_specializace);
 V   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_fk_specializace_fkey;
       public          postgres    false    227    229    4690            �   z  x���=n�@�k�)�����v���F�4k���P�d�I�&,R�q��^��Y\��u� �l����73o��]1ە���w;'����\���N�P1�0i�2\��(����N�,Y�Q��ז\g�����%ْ����yb}�d�)�=��K@���o��
#aFi��c;#�v���i��͖H˷�⡨�<�/�	���n�m�j�`�}O��J��V��ǖ������mV��F M����~?��s;ex��|��9.ԡQ���Mc�SQC)0���ԩ���o�f��А�CͰ���x�����(��ǟc�u�0��dk��;��N��n�gm(�4��?u����N�|��_w\77O�/�m��viGX{�4u˰6|ӈi��|O4�Lp�9}/�������=�ݏ2��!���ݸ���<���6���U���=C���7 ��% X@�L�O�����JB�8>P��ȝ���cC�-'�q�k}UJ�*�٦�JI�LA�U)L� �����2� kY��I�e�Q�6�ҟ	]�a�u����P�����M�s�u��i��ҩ�r�_��@F��
�rv|r #L�`��)�owpR�PO�����T���)\WQ~�yc�?��U�PI���s&�|Z�bQlve���"׆v��p��ٺ=��7���S�;h	�֍!"��CP�HTc�g�M�{��C�VI�A����J��4h]�nS�|zB�-�_<��C�2ꑈ>��	�7�Ϗ�n��l��~v���:"��w;0:YĠs�I���;|��Ś��ؕ��bu��-�Z7î���rNn�IƤ.�舭9��q���@��v Bܧt��\�F��*�(��K	b�~��?"�ɵ      �     x�=�ۑ�H�%c.��g��o�2���L%"QM��ߧ}������W���?�f�x2c^̘73[|�1_f�3�x��17f̝�+̘'3���#�̘3���<?��Θ��	7f��3c̘'3]��1of�ѕ��ݿ�puqi���_��.x>C�(��7.1$��z�U��_w�P��B���]T��J��"��Z��\��&���1ۤ��K�1�<��cDO+AF	'�Z	�H2bɈ�VN&���.��
��f$[��l�M6#�z��d3��X���]X���+�&��l�C�^)ٌd3��W�C6#ٌ�d��ad#���^�p�#�ad?z-�eA�l�����b҈I#&G9��>�4br���FL19�كI#&�}p�ѡ!�8:6d
*L�q��
�+�g}f#Y�h�N�S���a�ͣN��l�cs�d3EN�A�a���ԑ���0٧2N���&�T�I�0��d��8�&{�^�OL��E�a�]ML�a����#tQo�~�x^��Ƴy�y���s��zR��g��K7nø�v���m�a�.9<���|���!����a<����!�󃇭��x�o[�/mV��?��]��b�?�z�׋f�;� �>s��凜0r���z���FN���z��X�0�f�^;?��X�0�����a���y��ad�;2�~�td������0~�,��[��`a�<ȫ�X���*� �y�7Lޫ\��a�Y���d��,X'W�'N�8�;����������      �   �   x�}�M�0�׏Sp����DPSQW�i���T0ѫxϡ�(���73/f�������2�C�!��'�(�#_�aa�K�R���ѐ��`��q�EMu�}���'7)\��F,�����3�\��R��!`v���hD��H�`�إ+;�<�uO���/Y8'`T�3��.�,�Z�h~K��F�Ö���Kd�W�tp��Ӵ���D� EQ�0���      �   :  x�͖�n�6����8���N�����8^��M�^
Z�#FiP�{ؓ�f���aWY�kG[iҸ?��(���;��o��y���w���Z��{['���m�A�ێg{��9>vmǵ��Er�ӿ�"F��ܐְuB2���������w��%g��nN�>[+3[��݀��t�2�%7Z�sN�p�j�%�1��/F$.�^�L#�2�������8)�sƙ&�L�i�I(d�Q�@F#bv.E��%$,�:�*c�����oI�JxI��c0Lָj�J�/6�ָB*�H��B�����$/�﹥N�m�"mM�\3Q�7aT0J>�?������5��\�1�R��/�Е]Q��)�i�Ce��TX\��4A0��r�γ!�{d:_�U��h:o?1sN0�q&J�∣5�f��+���qt�2^� f-�rt��j�|ilh.9V�Ӝ�ޠ2���!tp�0.lgK"hR��&����ho�J�پ@o�|�H�_��]�eT+**�2%S2<�&�J
</K�~u>{Q=̦��A�fB��q?N�9isZ�ʡFU�������n�[����QL��8�U��g�QE�<�1x{��0Z��	tN[ڢ4�ɻ%-Cl�~;�{Vo��^���kF�����}�B��#ὁ����y���:��aҚPihb	u���qvMx&'m8^/�҈P�ػ�w�-び���n$FB��DW|�WU����!~�ZӺ�l���g������{|�|[U�4�������l�����"����VE�A̷D���*4�_D��}5y=S���]��tՀ}��4ۗ�����d������nØ�0�iٹ�)��
N�����5�r�e����� ��%����;�T����,��A����;�5!)�}/��H�x�N`��>]�+׆�ۿ�$b�m�����4�H��\�"	)��5�+0Pq�ͺA�ٚ7���ò��r�u�I"w��0>�Q,�'x�Z�x\��g���0�e��bf~����~�&NV,��ȹm����5���|OP�9�y�D����˄��@y������N/T��`Ýu���1�1�p]�@�뜛�}���+l��m�=�H�M	�v�A��}�:�Kt�5��U4,����v���������k˰��<3��+E�����Ŵ�ݹV����޿�>�&d��KW"�/gx�:��^?�����o��7n�;w���,L����{������6�ب����K����z0��5�ewM��P�Ľ�ǯ�j�!��]k��px~~O��+����峃���$)      �   �   x��K��0����L�|Hr�w�s��ƢL'ȦZ�Jo�:ڠ�6��-��^�&�s��\2=�E
tb��m�x#Ipi��&  x��`r���ҹJl������xH�ۛ�5Pog�ܙ��L]�.�ψ�e�pP�f)
��@�z�4�*J�V��o���'�6
��B����X��K�nU:C�l��N!Cj^3Gu��T^j/gc���"6M�����g�CW���������z�J      �   �   x�3��9�2;��L.#Ψ��Ĳ����k�S�K����b��ه�*��&g�efs�p:��f�e��d��t���^��e���Rpt}QPB،�-�(719��bXAQbr>Ho6�9gHjQbP�˂38?9�l(B�%�g�i1z\\\ EIK5      �   �   x�]�MN�@�מS�����?U �B�b�$CcM≜)R��X���bHR$X���{�.s���Ȩ	<1�ほ6*�O��C�ߺVM�ac]�-¨r�2��g�5��@���ڛw�j���%�_?�2�]˨V{'Į@ix7װ��4������GUk���M�RRzל9۳�b�
Ya�A�����	������PA� /�'!P���Kx�'�v+�C��Q�a�^ΔR߭C~O      �   �   x�5�K�0����Z-��D0�Ԉ!n�Uˣ��F�B����f�o3
��������
❅��$W�I��tp��t1��!�Zb�a�]���r=}oi�ܨsc�(¾��e?��@�l�QX��ߚ
��o���Ml+�LrQD�#�8�dj/w�O����fed��bn�j�T�x����X@A�     