PGDMP  '                    |            PatientCare    16.0    16.0 C    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                        1262    16398    PatientCare    DATABASE     �   CREATE DATABASE "PatientCare" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Czech_Czechia.1250';
    DROP DATABASE "PatientCare";
                postgres    false            �            1259    16476    log    TABLE     �   CREATE TABLE public.log (
    id integer NOT NULL,
    datum date,
    fk_zamestnanci integer,
    nazev_akce character varying(64),
    fk_pacienti integer
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
       public          postgres    false    230                       0    0 
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
       public          postgres    false    226                       0    0    luzka_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.luzka_id_seq OWNED BY public.luzka.id;
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
       public          postgres    false    220                       0    0    oddeleni_id_seq    SEQUENCE OWNED BY     L   ALTER SEQUENCE public.oddeleni_id_seq OWNED BY public.oddeleni.fk_oddeleni;
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
       public          postgres    false    224                       0    0    pacienti_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.pacienti_id_seq OWNED BY public.pacienti.fk_pacient;
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
       public          postgres    false    222                       0    0    pokoje_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.pokoje_id_seq OWNED BY public.pokoje.fk_pokoj;
          public          postgres    false    221            �            1259    16400    pozice    TABLE     Y   CREATE TABLE public.pozice (
    id integer NOT NULL,
    nazev character varying(32)
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
       public          postgres    false    216                       0    0    pozice_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.pozice_id_seq OWNED BY public.pozice.id;
          public          postgres    false    215            �            1259    16407    specializace    TABLE     _   CREATE TABLE public.specializace (
    id integer NOT NULL,
    nazev character varying(32)
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
       public          postgres    false    218                       0    0    specializace_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.specializace_id_seq OWNED BY public.specializace.id;
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
       public          postgres    false    228                       0    0    zamestnanci_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.zamestnanci_id_seq OWNED BY public.zamestnanci.id;
          public          postgres    false    227            D           2604    16479    log id    DEFAULT     `   ALTER TABLE ONLY public.log ALTER COLUMN id SET DEFAULT nextval('public.log_id_seq'::regclass);
 5   ALTER TABLE public.log ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    229    230    230            B           2604    16445    luzka id    DEFAULT     d   ALTER TABLE ONLY public.luzka ALTER COLUMN id SET DEFAULT nextval('public.luzka_id_seq'::regclass);
 7   ALTER TABLE public.luzka ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    225    226    226            ?           2604    16417    oddeleni fk_oddeleni    DEFAULT     s   ALTER TABLE ONLY public.oddeleni ALTER COLUMN fk_oddeleni SET DEFAULT nextval('public.oddeleni_id_seq'::regclass);
 C   ALTER TABLE public.oddeleni ALTER COLUMN fk_oddeleni DROP DEFAULT;
       public          postgres    false    220    219    220            A           2604    16436    pacienti fk_pacient    DEFAULT     r   ALTER TABLE ONLY public.pacienti ALTER COLUMN fk_pacient SET DEFAULT nextval('public.pacienti_id_seq'::regclass);
 B   ALTER TABLE public.pacienti ALTER COLUMN fk_pacient DROP DEFAULT;
       public          postgres    false    223    224    224            @           2604    16424    pokoje fk_pokoj    DEFAULT     l   ALTER TABLE ONLY public.pokoje ALTER COLUMN fk_pokoj SET DEFAULT nextval('public.pokoje_id_seq'::regclass);
 >   ALTER TABLE public.pokoje ALTER COLUMN fk_pokoj DROP DEFAULT;
       public          postgres    false    221    222    222            =           2604    16403 	   pozice id    DEFAULT     f   ALTER TABLE ONLY public.pozice ALTER COLUMN id SET DEFAULT nextval('public.pozice_id_seq'::regclass);
 8   ALTER TABLE public.pozice ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            >           2604    16410    specializace id    DEFAULT     r   ALTER TABLE ONLY public.specializace ALTER COLUMN id SET DEFAULT nextval('public.specializace_id_seq'::regclass);
 >   ALTER TABLE public.specializace ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218            C           2604    16462    zamestnanci id    DEFAULT     p   ALTER TABLE ONLY public.zamestnanci ALTER COLUMN id SET DEFAULT nextval('public.zamestnanci_id_seq'::regclass);
 =   ALTER TABLE public.zamestnanci ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    228    227    228            �          0    16476    log 
   TABLE DATA           Q   COPY public.log (id, datum, fk_zamestnanci, nazev_akce, fk_pacienti) FROM stdin;
    public          postgres    false    230   �I       �          0    16442    luzka 
   TABLE DATA           F   COPY public.luzka (id, cislo_luzka, fk_pokoj, fk_pacient) FROM stdin;
    public          postgres    false    226   J       �          0    16414    oddeleni 
   TABLE DATA           ?   COPY public.oddeleni (fk_oddeleni, nazev, img_src) FROM stdin;
    public          postgres    false    220   M       �          0    16433    pacienti 
   TABLE DATA           �   COPY public.pacienti (fk_pacient, rodne_cislo, jmeno, prijmeni, datum_narozeni, den_hospitalizace, rezim_operacni_den, info_json) FROM stdin;
    public          postgres    false    224    N       �          0    16421    pokoje 
   TABLE DATA           E   COPY public.pokoje (fk_pokoj, cislo_pokoje, fk_oddeleni) FROM stdin;
    public          postgres    false    222   �N       �          0    16400    pozice 
   TABLE DATA           +   COPY public.pozice (id, nazev) FROM stdin;
    public          postgres    false    216   �O       �          0    16407    specializace 
   TABLE DATA           1   COPY public.specializace (id, nazev) FROM stdin;
    public          postgres    false    218   hP       �          0    16459    zamestnanci 
   TABLE DATA           q   COPY public.zamestnanci (id, jmeno, prijmeni, prihlasovaci_jmeno, heslo, fk_pozice, fk_specializace) FROM stdin;
    public          postgres    false    228   dQ       	           0    0 
   log_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.log_id_seq', 1, false);
          public          postgres    false    229            
           0    0    luzka_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.luzka_id_seq', 276, true);
          public          postgres    false    225                       0    0    oddeleni_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.oddeleni_id_seq', 14, true);
          public          postgres    false    219                       0    0    pacienti_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.pacienti_id_seq', 39, true);
          public          postgres    false    223                       0    0    pokoje_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.pokoje_id_seq', 92, true);
          public          postgres    false    221                       0    0    pozice_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.pozice_id_seq', 9, true);
          public          postgres    false    215                       0    0    specializace_id_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.specializace_id_seq', 17, true);
          public          postgres    false    217                       0    0    zamestnanci_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.zamestnanci_id_seq', 1, true);
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
   CONSTRAINT     P   ALTER TABLE ONLY public.pozice
    ADD CONSTRAINT pozice_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.pozice DROP CONSTRAINT pozice_pkey;
       public            postgres    false    216            H           2606    16412    specializace specializace_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.specializace
    ADD CONSTRAINT specializace_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.specializace DROP CONSTRAINT specializace_pkey;
       public            postgres    false    218            R           2606    16464    zamestnanci zamestnanci_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_pkey;
       public            postgres    false    228            Z           2606    16487    log log_fk_pacienti_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.log
    ADD CONSTRAINT log_fk_pacienti_fkey FOREIGN KEY (fk_pacienti) REFERENCES public.pacienti(fk_pacient);
 B   ALTER TABLE ONLY public.log DROP CONSTRAINT log_fk_pacienti_fkey;
       public          postgres    false    4686    224    230            [           2606    16482    log log_fk_zamestnanci_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.log
    ADD CONSTRAINT log_fk_zamestnanci_fkey FOREIGN KEY (fk_zamestnanci) REFERENCES public.zamestnanci(id);
 E   ALTER TABLE ONLY public.log DROP CONSTRAINT log_fk_zamestnanci_fkey;
       public          postgres    false    230    4690    228            V           2606    16453    luzka luzka_fk_pacient_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.luzka
    ADD CONSTRAINT luzka_fk_pacient_fkey FOREIGN KEY (fk_pacient) REFERENCES public.pacienti(fk_pacient);
 E   ALTER TABLE ONLY public.luzka DROP CONSTRAINT luzka_fk_pacient_fkey;
       public          postgres    false    226    224    4686            W           2606    16448    luzka luzka_fk_pokoj_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.luzka
    ADD CONSTRAINT luzka_fk_pokoj_fkey FOREIGN KEY (fk_pokoj) REFERENCES public.pokoje(fk_pokoj);
 C   ALTER TABLE ONLY public.luzka DROP CONSTRAINT luzka_fk_pokoj_fkey;
       public          postgres    false    226    4684    222            U           2606    16427    pokoje pokoje_fk_oddeleni_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.pokoje
    ADD CONSTRAINT pokoje_fk_oddeleni_fkey FOREIGN KEY (fk_oddeleni) REFERENCES public.oddeleni(fk_oddeleni);
 H   ALTER TABLE ONLY public.pokoje DROP CONSTRAINT pokoje_fk_oddeleni_fkey;
       public          postgres    false    4682    220    222            X           2606    16465 &   zamestnanci zamestnanci_fk_pozice_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_fk_pozice_fkey FOREIGN KEY (fk_pozice) REFERENCES public.pozice(id);
 P   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_fk_pozice_fkey;
       public          postgres    false    216    4678    228            Y           2606    16470 ,   zamestnanci zamestnanci_fk_specializace_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.zamestnanci
    ADD CONSTRAINT zamestnanci_fk_specializace_fkey FOREIGN KEY (fk_specializace) REFERENCES public.specializace(id);
 V   ALTER TABLE ONLY public.zamestnanci DROP CONSTRAINT zamestnanci_fk_specializace_fkey;
       public          postgres    false    228    218    4680            �      x������ � �      �   �  x�=�ۍ�@ľ��14�Q�����eW��&��d�n�}��O�����}����/���g��`f�'3�Ōy3�Ň�e��2s��Ì�1c��\�`�<�1/f^�f�|�1��������<ߙ0�&�̘3��L/f̛��z��tO���\��������3��T���"�D����X��U��_��Fz�՗�"~���U�ʭ�@ї=�Edn�Ie� ��ƭZ��"�RB�*2�d$��P��R�%��j�f��H/#�Zՙ3�L�pl%��4biD���BS��4��TBM#�ƺ]@݂��A�f/���M�A���Aӈ��^BM#�F��E��ș��^Gq9#�b�Tz���V������]J)i��f���FJ�j�R�HI#%G5{)i���=h����0"aL���%��x�؄�1w�6��v�fq�Q����z���J�Y��<�^������=X`��q�r���q�>�8q��}�q��=�.�#f���6ìs51���0]��b�av��R�E�0�͛�K=7��t�/O�����\�@�t^���s��K=��t�y��s���K���>a������'L�0}�:\���c~���O�>a�lux��O����ø�q��yp��ƶ>Gn,̍������37n,Lã�F�0��9CL�0}̝>G�y:}��	���;O�O�>a���;O�~�܏y�~�8p����q�n���q�r���qs?W�[&��~����0����ߟ����S��      �   �   x�}�M�0�׏Sp����DPSQW�i���T0ѫxϡ�(���73/f�������2�C�!��'�(�#_�aa�K�R���ѐ��`��q�EMu�}���'7)\��F,�����3�\��R��!`v���hD��H�`�إ+;�<�uO���/Y8'`T�3��.�,�Z�h~K��F�Ö���Kd�W�tp��Ӵ���D� EQ�0���      �   �   x���!�PEQ=�Kɟ7��8T%Q����F0�}������y���uE׷�������<���:yn���+Y������h����iU�<�����a��O��tY���-O��/O=��A+�1d��9Ps���M�M�M�M�M�M�M�M�M�M�-�[ � n��p��-�[ �����'-�{�      �   �   x��K��0����L�|Hr�w�s��ƢL'ȦZ�Jo�:ڠ�6��-��^�&�s��\2=�E
tb��m�x#Ipi��&  x��`r���ҹJl������xH�ۛ�5Pog�ܙ��L]�.�ψ�e�pP�f)
��@�z�4�*J�V��o���'�6
��B����X��K�nU:C�l��N!Cj^3Gu��T^j/gc���"6M�����g�CW���������z�J      �   �   x�3��9�2;��L.#Ψ��Ĳ����k�S�K����b��ه�*��&g�efs�p:��f�e��d��t���^��e���Rpt}QPB،�-�(719��bXAQbr>Ho6�9gHjQbP�˂38?9�l(B�%�g�i1z\\\ EIK5      �   �   x�U�MN�@�מS��_X"�	)��3kO�L��8@��"��C�.�|~ϟ�5�$ٓUsxe
�#�]R�?O�&|��Z�c�����X�I���Lf0���9a�HX�-�&�/�j/������xL�1�kH�b_�����7�kZSLP}�V*��5<�u#�m�)=�νXcl�_�[Q,!ewvV�mc�`��!�fTR@�5<c�%�˶zo��r�>SJ�w�xO      �   W   x�3�LL���C!U�*UT����C�M�ܳB�����ӓ|�3",]Rs���s���ݽ��̒�M]<\ͽ�rr9c���+F��� "J�     